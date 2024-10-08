<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelembapanIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelembapanIspaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $kelembapanIspa = KelembapanIspa::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.ISPA.kelembapan.index', compact('kelembapanIspa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ISPA.kelembapan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filePath = $request->file('file')->getRealPath();
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);
        // @dd($data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $banner = $request->file('gambar');
            $banner->storeAs('public/kelembapanIspa/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            KelembapanIspa::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'kelembapan' => $feature['properties']['kelembaban'],
                'kelas' => $feature['properties']['kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.kelembapan-ispa.index')->with('success', 'Data Berhasil Disimpan!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelembapanIspa $kelembapanIspa)
    {
        return view('pages.admin.ISPA.kelembapan.edit', compact('kelembapanIspa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $kelembapanIspa = KelembapanIspa::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $kelembapanIspa->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'kelas' => $request->input('kelas'),
            'kelembapan' => $request->input('kelembapan'),
        ]);

        return redirect()->route('admin.kelembapan-ispa.index')->with('success', 'Kelembapan ISPA berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelembapanIspa = KelembapanIspa::findOrFail($id);
        $allKelembapanIspa = KelembapanIspa::where('tanggal', $kelembapanIspa->tanggal)->get();
        if ($allKelembapanIspa->count() === 1 && $kelembapanIspa->gambar) {
            Storage::delete('public/kelembapanIspa/' . $kelembapanIspa->gambar);
        }
        // Hapus data kelembapanIspa
        $kelembapanIspa->delete();
        return redirect()->route('admin.kelembapan-ispa.index')->with('success', 'Kelembapan ISPA berhasil dihapus!');
    }
}
