<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendudukMiskinHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendudukMiskinHivController extends Controller
{
    public function index()
    {
        $pendudukMiskinHiv = PendudukMiskinHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.pendudukMiskinHiv.index', compact('pendudukMiskinHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.pendudukMiskinHiv.create');
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
            $banner->storeAs('public/pendudukMiskinHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            PendudukMiskinHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'pdd_miskin' => $feature['properties']['Pdd_Miskin'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.penduduk-miskin-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PendudukMiskinHiv $pendudukMiskinHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendudukMiskinHiv $pendudukMiskinHiv)
    {
        return view('pages.admin.HIV.pendudukMiskinHiv.edit', compact('pendudukMiskinHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendudukMiskinHiv = PendudukMiskinHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $pendudukMiskinHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'pdd_miskin' => $request->input('pdd_miskin'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.penduduk-miskin-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendudukMiskinHiv = PendudukMiskinHiv::findOrFail($id);
        $allPendudukMiskinHiv = PendudukMiskinHiv::where('tanggal', $pendudukMiskinHiv->tanggal)->get();
        if ($allPendudukMiskinHiv->count() === 1 && $pendudukMiskinHiv->gambar) {
            Storage::delete('public/pendudukMiskinHiv/' . $pendudukMiskinHiv->gambar);
        }
        // Hapus data pendudukMiskinHiv
        $pendudukMiskinHiv->delete();
        return redirect()->route('admin.penduduk-miskin-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
