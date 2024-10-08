<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

    // Cek apakah user yang dihapus adalah user yang sedang login
    if (auth()->user()->id == $user->id) {
        return redirect()->route('admin.user.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
    }

    $user->delete();

    return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }

    public function profile()
    {
        $user = auth()->user(); // Mengambil data user yang sedang login
        return view('pages.admin.user.profile', compact('user'));
    }

   public function updateProfile(Request $request, string $id)
    {
        // Cari user berdasarkan ID atau tampilkan error 404 jika tidak ditemukan
        $user = User::findOrFail($id);

        // Validasi input dari request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // memastikan email unik, kecuali untuk user ini sendiri
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // validasi file gambar
        ]);

        // Proses update data user
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        // Cek apakah ada file gambar diupload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/userImage/' . $gambar->hashName());
            if ($user->gambar) {
                Storage::delete('public/userImage/' . $user->gambar);
            }
            // Simpan gambar baru dan tambahkan ke array data yang akan di-update
            $data['gambar'] = $gambar->hashName();
        }

        // Update user dengan data baru
        $user->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

}
