<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendudukPriaProduktivHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendudukPriaProduktivHivController extends Controller
{
   public function index()
    {
        $pendudukPriaProduktivHiv = PendudukPriaProduktivHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.pendudukPriaProduktivHiv.index', compact('pendudukPriaProduktivHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.pendudukPriaProduktivHiv.create');
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
            $banner->storeAs('public/pendudukPriaProduktivHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            PendudukPriaProduktivHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'pdd_lk_pro' => $feature['properties']['Pdd_Lk_Pro'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.penduduk-pria-usi-produktiv-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PendudukPriaProduktivHiv $pendudukPriaProduktivHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendudukPriaProduktivHiv $penduduk_pria_usi_produktiv_hiv)
    {
        return view('pages.admin.HIV.pendudukPriaProduktivHiv.edit', compact('penduduk_pria_usi_produktiv_hiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendudukPriaProduktivHiv = PendudukPriaProduktivHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $pendudukPriaProduktivHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'pdd_lk_pro' => $request->input('pdd_lk_pro'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.penduduk-pria-usi-produktiv-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendudukPriaProduktivHiv = PendudukPriaProduktivHiv::findOrFail($id);
        $allPendudukPriaProduktivHiv = PendudukPriaProduktivHiv::where('tanggal', $pendudukPriaProduktivHiv->tanggal)->get();
        if ($allPendudukPriaProduktivHiv->count() === 1 && $pendudukPriaProduktivHiv->gambar) {
            Storage::delete('public/pendudukPriaProduktivHiv/' . $pendudukPriaProduktivHiv->gambar);
        }
        // Hapus data pendudukPriaProduktivHiv
        $pendudukPriaProduktivHiv->delete();
        return redirect()->route('admin.penduduk-pria-usi-produktiv-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
