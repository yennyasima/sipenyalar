<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaskesPdpHiv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaskesPdpHivController extends Controller
{
    public function index()
    {
        $faskesPdpHiv = FaskesPdpHiv::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.HIV.faskesPdpHiv.index', compact('faskesPdpHiv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.HIV.faskesPdpHiv.create');
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
            $banner->storeAs('public/faskesPdpHiv/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            FaskesPdpHiv::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['Kecamatan'],
                'faskes_pdp' => $feature['properties']['Faskes_PDP'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.faskes-pdp-hiv.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FaskesPdpHiv $faskesPdpHiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaskesPdpHiv $faskesPdpHiv)
    {
        return view('pages.admin.HIV.faskesPdpHiv.edit', compact('faskesPdpHiv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faskesPdpHiv = FaskesPdpHiv::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $faskesPdpHiv->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'faskes_pdp' => $request->input('faskes_pdp'),
        ]);

        return redirect()->route('admin.faskes-pdp-hiv.index')->with('success', 'Data Penyakit HIV berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faskesPdpHiv = FaskesPdpHiv::findOrFail($id);
        $allFaskesPdpHiv = FaskesPdpHiv::where('tanggal', $faskesPdpHiv->tanggal)->get();
        if ($allFaskesPdpHiv->count() === 1 && $faskesPdpHiv->gambar) {
            Storage::delete('public/faskesPdpHiv/' . $faskesPdpHiv->gambar);
        }
        // Hapus data faskesPdpHiv
        $faskesPdpHiv->delete();
        return redirect()->route('admin.faskes-pdp-hiv.index')->with('success', 'Data Penyakit HIV berhasil dihapus!');
    }
}
