<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotspotHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotspotHivController extends Controller
{
    public function index()
    {
        $hotspotHiv = HotspotHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.hotspotHiv.index', compact('hotspotHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.hotspotHiv.create');
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
            $banner->storeAs('public/hotspotHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            HotspotHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['Kecamatan'],
                'ha_kasus' => $feature['properties']['HA_Kasus'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.hostpot-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HotspotHiv $hotspotHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotspotHiv $hostpotHiv)
    {
        return view('pages.admin.HIV.hotspotHiv.edit', compact('hostpotHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotspotHiv = HotspotHiv::findOrFail($id);
        $request->validate([
            'geometry' => 'required|json',
        ]);

        $hotspotHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'ha_kasus' => $request->input('ha_kasus'),
            'kelas_hiv' => $request->input('kelas_hiv'),
        ]);

        return redirect()->route('admin.hostpot-hiv.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotspotHiv = HotspotHiv::findOrFail($id);
        $allHotspotHiv = HotspotHiv::where('tanggal', $hotspotHiv->tanggal)->get();
        if ($allHotspotHiv->count() === 1 && $hotspotHiv->gambar) {
            Storage::delete('public/hotspotHiv/' . $hotspotHiv->gambar);
        }
        // Hapus data hotspotHiv
        $hotspotHiv->delete();
        return redirect()->route('admin.hostpot-hiv.index')->with('success', 'Data Hotspot HIV berhasil dihapus!');
    }
}
