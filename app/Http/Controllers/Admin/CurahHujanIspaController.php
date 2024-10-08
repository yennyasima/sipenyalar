<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurahHujanIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurahHujanIspaController extends Controller
{
   public function index()
    {
        $curahHujanIspa = CurahHujanIspa::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.ISPA.curahHujan.index', compact('curahHujanIspa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ISPA.curahHujan.create');
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
            $banner->storeAs('public/curahHujanIspa/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            CurahHujanIspa::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'ch' => $feature['properties']['CH'],
                'kelas' => $feature['properties']['KELAS'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.curah-hujan-ispa.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CurahHujanIspa $curahHujanIspa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurahHujanIspa $curahHujanIspa)
    {
        return view('pages.admin.ISPA.curahHujan.edit', compact('curahHujanIspa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $curahHujanIspa = CurahHujanIspa::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $curahHujanIspa->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'curah_hujan' => $request->input('curah_hujan'),
            'ch' => $request->input('ch'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.curah-hujan-ispa.index')->with('success', 'Data Penyakit ISPA berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $curahHujanIspa = CurahHujanIspa::findOrFail($id);
        $allCurahHujanIspa = CurahHujanIspa::where('tanggal', $curahHujanIspa->tanggal)->get();
        if ($allCurahHujanIspa->count() === 1 && $curahHujanIspa->gambar) {
            Storage::delete('public/curahHujanIspa/' . $curahHujanIspa->gambar);
        }
        // Hapus data curahHujanIspa
        $curahHujanIspa->delete();
        return redirect()->route('admin.curah-hujan-ispa.index')->with('success', 'Data Penyakit ISPA berhasil dihapus!');
    }
}
