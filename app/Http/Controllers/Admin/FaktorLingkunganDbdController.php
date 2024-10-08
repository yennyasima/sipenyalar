<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaktorLingkunganDbd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaktorLingkunganDbdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faktorLingkungan = FaktorLingkunganDbd::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.DBD.faktorLingkungan.index', compact('faktorLingkungan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.admin.DBD.faktorLingkungan.create');
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
            $banner->storeAs('public/faktorLingkunganDbd/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            FaktorLingkunganDbd::create([
                'remark' => $feature['properties']['REMARK'],
                'kelurahan' => $feature['properties']['Kelurahan'],
                'kecamatan' => $feature['properties']['Kecamatan'],
                'curah_hujan' => $feature['properties']['Curah_Huja'],
                'kelembapan' => $feature['properties']['Kelembaban'],
                'suhu' => $feature['properties']['Suhu'],
                'tingkat_ka_suhu' => $feature['properties']['Tingkt_Suh'],
                'tingkat_ka_curah_hujan' => $feature['properties']['Tingkat_CH'],
                'tingkat_ka_kelembapan' => $feature['properties']['Tingkt_Kel'],
                'geometry' => json_encode($feature['geometry']),
                'gambar' => $gambar,
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
            ]);
        }

        return redirect()->route('admin.faktor-lingkungan-dbd.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FaktorLingkunganDbd $faktorLingkunganDbd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaktorLingkunganDbd $faktorLingkunganDbd)
    {
         return view('pages.admin.DBD.faktorLingkungan.edit', compact('faktorLingkunganDbd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faktorLinFaktorLingkunganDbd = FaktorLingkunganDbd::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $faktorLinFaktorLingkunganDbd->update([
            'remark' => $request->input('remark'),
            'kelurahan' => $request->input('kelurahan'),
            'kecamatan' => $request->input('kecamatan'),
            'curah_hujan' => $request->input('curah_hujan'),
            'kelembapan' => $request->input('kelembapan'),
            'suhu' => $request->input('suhu'),
            'tingkat_ka_suhu' => $request->input('tingkat_ka_suhu'),
            'tingkat_ka_curah_hujan' => $request->input('tingkat_ka_curah_hujan'),
            'tingkat_ka_kelembaban' => $request->input('tingkat_ka_kelembaban'),
            'geometry' => $request->input('geometry'),
        ]);

        return redirect()->route('admin.faktor-lingkungan-dbd.index')->with('success', 'Kepadatan Penduduk DBD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faktorLinFaktorLingkunganDbd = FaktorLingkunganDbd::findOrFail($id);
        $allFaktorLingkunganDbd = FaktorLingkunganDbd::where('tanggal', $faktorLinFaktorLingkunganDbd->tanggal)->get();
        if ($allFaktorLingkunganDbd->count() === 1 && $faktorLinFaktorLingkunganDbd->gambar) {
            Storage::delete('public/faktorLingkunganDbd/' . $faktorLinFaktorLingkunganDbd->gambar);
        }
        // Hapus data dataPenyakitDbd
        $faktorLinFaktorLingkunganDbd->delete();
        return redirect()->route('admin.faktor-lingkungan-dbd.index')->with('success', 'Data Penyakit DBD berhasil dihapus!');
    }
}
