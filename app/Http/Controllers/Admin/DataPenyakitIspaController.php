<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenyakitIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPenyakitIspaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DataPenyakitIspa = DataPenyakitIspa::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.ISPA.dataPenyakit.index', compact('DataPenyakitIspa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ISPA.dataPenyakit.create');
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
            $banner->storeAs('public/dataPenyakitIspa/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            DataPenyakitIspa::create([
                'geometry' => json_encode($feature['geometry']),
                'kecamatan' => $feature['properties']['KECAMATAN'],
                'luas_kec' => $feature['properties']['Luas_Kec'],
                'puskesmas' => $feature['properties']['Puskesmas'],
                'jumlah_balita' => $feature['properties']['Jumlah_Bal'],
                'jumlah_ispa_penderita' => $feature['properties']['jml_ispa_p'],
                'nilai_range' => $feature['properties']['NilaiRange'],
                'kelas' => $feature['properties']['Kelas'],
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.data-penyakit-ispa.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPenyakitIspa $dataPenyakitIspa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPenyakitIspa $dataPenyakitIspa)
    {
        return view('pages.admin.ISPA.dataPenyakit.edit', compact('dataPenyakitIspa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $dataPenyakitIspa = DataPenyakitIspa::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $dataPenyakitIspa->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'luas_kec' => $request->input('luas_kec'),
            'puskesmas' => $request->input('puskesmas'),
            'jumlah_balita' => $request->input('jumlah_balita'),
            'jumlah_ispa_penderita' => $request->input('jumlah_ispa_penderita'),
            'nilai_range' => $request->input('nilai_range'),
            'kelas' => $request->input('kelas'),
        ]);

        return redirect()->route('admin.data-penyakit-ispa.index')->with('success', 'Data Penyakit ISPA berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPenyakitIspa = DataPenyakitIspa::findOrFail($id);
        $allDataPenyakitIspa = DataPenyakitIspa::where('tanggal', $dataPenyakitIspa->tanggal)->get();
        if ($allDataPenyakitIspa->count() === 1 && $dataPenyakitIspa->gambar) {
            Storage::delete('public/dataPenyakitIspa/' . $dataPenyakitIspa->gambar);
        }
        // Hapus data dataPenyakitIspa
        $dataPenyakitIspa->delete();
        return redirect()->route('admin.data-penyakit-ispa.index')->with('success', 'Data Penyakit ISPA berhasil dihapus!');
    }
}
