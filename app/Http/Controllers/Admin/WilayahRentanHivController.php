<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WilayahRentanHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WilayahRentanHivController extends Controller
{
    public function index()
    {
        $wilayahRentanHiv = WilayahRentanHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.wilayahRentan.index', compact('wilayahRentanHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.wilayahRentan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filePath = $request->file('file')->getRealPath();
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);


        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $banner = $request->file('gambar');
            $banner->storeAs('public/wilayahRentanHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            WilayahRentanHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'nilai_wr' => $feature['properties']['Nilai_WR'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.wilayah-rentan-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WilayahRentanHiv $wilayahRentanHiv)
    {
        return view('pages.admin.HIV.wilayahRentan.edit', compact('wilayahRentanHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wilayahRentanHiv = WilayahRentanHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $wilayahRentanHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'nilai_wr' => $request->input('nilai_wr'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.wilayah-rentan-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wilayahRentanHiv = WilayahRentanHiv::findOrFail($id);
        $allWilayahRentanHiv = WilayahRentanHiv::where('tanggal', $wilayahRentanHiv->tanggal)->get();
        if ($allWilayahRentanHiv->count() === 1 && $wilayahRentanHiv->gambar) {
            Storage::delete('public/wilayahRentanHiv/' . $wilayahRentanHiv->gambar);
        }
        // Hapus data wilayahRentanHiv
        $wilayahRentanHiv->delete();
        return redirect()->route('admin.wilayah-rentan-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
