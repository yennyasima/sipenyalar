<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenyakitDbd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPenyakitDbdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DataPenyakitDbd = DataPenyakitDbd::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.DBD.dataPenyakit.index', compact('DataPenyakitDbd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.DBD.dataPenyakit.create');
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
            $banner->storeAs('public/dataPenyakitDbd/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        foreach ($data['features'] as $feature) {
            DataPenyakitDbd::create([
                'remark' => $feature['properties']['REMARK'],
                'kelurahan' => $feature['properties']['Kelurahan'],
                'kecamatan' => $feature['properties']['Kecamatan'],
                'kasus' => $feature['properties']['Kasus'],
                'tingkat_ka' => $feature['properties']['Tingkat_Ka'],
                'geometry' => json_encode($feature['geometry']),
                'operator' => $request->operator,
                'tanggal' => $request->tanggal,
                'gambar' => $gambar,
            ]);
        }

        return redirect()->route('admin.data-penyakit-dbd.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPenyakitDbd $dataPenyakitDbd)
    {
        return view('pages.admin.DBD.dataPenyakit.edit', compact('dataPenyakitDbd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPenyakitDbd = DataPenyakitDbd::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $dataPenyakitDbd->update([
            'remark' => $request->input('remark'),
            'kelurahan' => $request->input('kelurahan'),
            'kecamatan' => $request->input('kecamatan'),
            'kasus' => $request->input('kasus'),
            'tingkat_ka' => $request->input('tingkat_ka'),
            'geometry' => $request->input('geometry'),
        ]);

        return redirect()->route('admin.data-penyakit-dbd.index')->with('success', 'Data Penyakit DBD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPenyakitDbd = DataPenyakitDbd::findOrFail($id);
        $allDataPenyakitDbd = DataPenyakitDbd::where('tanggal', $dataPenyakitDbd->tanggal)->get();
        if ($allDataPenyakitDbd->count() === 1 && $dataPenyakitDbd->gambar) {
            Storage::delete('public/dataPenyakitDbd/' . $dataPenyakitDbd->gambar);
        }
        // Hapus data dataPenyakitDbd
        $dataPenyakitDbd->delete();
        return redirect()->route('admin.data-penyakit-dbd.index')->with('success', 'Data Penyakit DBD berhasil dihapus!');
    }
}
