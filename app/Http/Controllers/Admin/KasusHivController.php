<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KasusHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KasusHivController extends Controller
{
    public function index()
    {
        $kasusHiv = KasusHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.kasusHIV.index', compact('kasusHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.kasusHIV.create');
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
            $banner->storeAs('public/kasusHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            KasusHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'ha_kasus' => $feature['properties']['HA_Kasus'],
                'kelas_hiv' => $feature['properties']['Kelas_HIV'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.kasus-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KasusHiv $kasusHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KasusHiv $kasusHiv)
    {
        return view('pages.admin.HIV.kasusHIV.edit', compact('kasusHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kasusHiv = KasusHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $kasusHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'ha_kasus' => $request->input('ha_kasus'),
            'kelas_hiv' => $request->input('kelas_hiv'),
        ]);

        return redirect()->route('admin.kasus-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kasusHiv = KasusHiv::findOrFail($id);
        $allKasusHiv = KasusHiv::where('tanggal', $kasusHiv->tanggal)->get();
        if ($allKasusHiv->count() === 1 && $kasusHiv->gambar) {
            Storage::delete('public/kasusHiv/' . $kasusHiv->gambar);
        }
        // Hapus data kasusHiv
        $kasusHiv->delete();
        return redirect()->route('admin.kasus-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
