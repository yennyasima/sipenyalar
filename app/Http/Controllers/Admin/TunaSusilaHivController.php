<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TunaSusilaHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TunaSusilaHivController extends Controller
{
   public function index()
    {
        $tunaSusilaHiv = TunaSusilaHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.tunaSusila.index', compact('tunaSusilaHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.tunaSusila.create');
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
            $banner->storeAs('public/tunaSusilaHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            TunaSusilaHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'tn_susila' => $feature['properties']['Tn_Susila'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.tuna-susila-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TunaSusilaHiv $tunaSusilaHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TunaSusilaHiv $tunaSusilaHiv)
    {
        return view('pages.admin.HIV.tunaSusila.edit', compact('tunaSusilaHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tunaSusilaHiv = TunaSusilaHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $tunaSusilaHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'tn_susila' => $request->input('tn_susila'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.tuna-susila-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tunaSusilaHiv = TunaSusilaHiv::findOrFail($id);
        $allTunaSusilaHiv = TunaSusilaHiv::where('tanggal', $tunaSusilaHiv->tanggal)->get();
        if ($allTunaSusilaHiv->count() === 1 && $tunaSusilaHiv->gambar) {
            Storage::delete('public/tunaSusilaHiv/' . $tunaSusilaHiv->gambar);
        }
        // Hapus data tunaSusilaHiv
        $tunaSusilaHiv->delete();
        return redirect()->route('admin.tuna-susila-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
