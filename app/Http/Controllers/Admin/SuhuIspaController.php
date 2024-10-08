<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuhuIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuhuIspaController extends Controller
{
    public function index()
    {
        $suhuIspa = SuhuIspa::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.ISPA.suhu.index', compact('suhuIspa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ISPA.suhu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil path file dari request
        $filePath = $request->file('file')->getRealPath();
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        // Cek apakah ada error pada JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }

        // Simpan gambar jika ada file gambar yang di-upload
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $banner = $request->file('gambar');
            $banner->storeAs('public/suhuIspa/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        // Loop melalui fitur data
        foreach ($data['features'] as $feature) {
            // Loop melalui semua properti dari fitur untuk mencari kunci suhu yang cocok
            foreach ($feature['properties'] as $key => $value) {
                // Gunakan regex untuk mencocokkan 'suhu' diikuti dengan dua digit angka
                if (preg_match('/^suhu\d+$/', $key)) {
                    // Jika cocok, buat entri baru di tabel SuhuIspa
                    SuhuIspa::create([
                        'suhu' => $value,
                        'kecamatan' => $feature['properties']['KECAMATAN'],
                        'kelas_suhu' => $feature['properties']['kelas_suhu'],
                        'geometry' => json_encode($feature['geometry']),
                        'operator' => $request->operator,
                        'tanggal' => $request->tanggal,
                        'gambar' => $gambar,
                    ]);
                }
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.suhu-ispa.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuhuIspa $suhuIspa)
    {
        return view('pages.admin.ISPA.suhu.edit', compact('suhuIspa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $suhuIspa = SuhuIspa::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $suhuIspa->update([
            'suhu' => $request->input('suhu'),
            'kecamatan' => $request->input('kecamatan'),
            'kelas_suhu' => $request->input('kelas_suhu'),
            'geometry' => $request->input('geometry'),
        ]);

        return redirect()->route('admin.suhu-ispa.index')->with('success', 'Suhu ISPA berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suhuIspa = SuhuIspa::findOrFail($id);
        $allSuhuIspa = SuhuIspa::where('tanggal', $suhuIspa->tanggal)->get();
        if ($allSuhuIspa->count() === 1 && $suhuIspa->gambar) {
            Storage::delete('public/suhuIspa/' . $suhuIspa->gambar);
        }
        // Hapus data suhuIspa
        $suhuIspa->delete();
        return redirect()->route('admin.suhu-ispa.index')->with('success', 'Suhu ISPA berhasil dihapus!');
    }
}
