<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiRawanTunaSusilaHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiRawanTunaSusilaHivController extends Controller
{
   public function index()
    {
        $lokasiRawanTunaSusilaHiv = LokasiRawanTunaSusilaHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.lokasiRawanTunaSusilaHiv.index', compact('lokasiRawanTunaSusilaHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.lokasiRawanTunaSusilaHiv.create');
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
            $banner->storeAs('public/lokasiRawanTunaSusilaHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            LokasiRawanTunaSusilaHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'lok_pros' => $feature['properties']['Lok_Pros'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.lokasi-rawan-tuna-susila-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiRawanTunaSusilaHiv $lokasiRawanTunaSusilaHiv)
    {
        return view('pages.admin.HIV.lokasiRawanTunaSusilaHiv.edit', compact('lokasiRawanTunaSusilaHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasiRawanTunaSusilaHiv = LokasiRawanTunaSusilaHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $lokasiRawanTunaSusilaHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'lok_pros' => $request->input('lok_pros'),
        ]);

        return redirect()->route('admin.lokasi-rawan-tuna-susila-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lokasiRawanTunaSusilaHiv = LokasiRawanTunaSusilaHiv::findOrFail($id);
        $allLokasiRawanTunaSusilaHiv = LokasiRawanTunaSusilaHiv::where('tanggal', $lokasiRawanTunaSusilaHiv->tanggal)->get();
        if ($allLokasiRawanTunaSusilaHiv->count() === 1 && $lokasiRawanTunaSusilaHiv->gambar) {
            Storage::delete('public/lokasiRawanTunaSusilaHiv/' . $lokasiRawanTunaSusilaHiv->gambar);
        }
        // Hapus data lokasiRawanTunaSusilaHiv
        $lokasiRawanTunaSusilaHiv->delete();
        return redirect()->route('admin.lokasi-rawan-tuna-susila-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
