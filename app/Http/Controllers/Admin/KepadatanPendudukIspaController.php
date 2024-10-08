<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KepadatanPendudukIspa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepadatanPendudukIspaController extends Controller
{
    public function index()
    {
        $kepadatanPendudukIspa = KepadatanPendudukIspa::paginate(10); // Ambil data kelurahan dengan pagination
        return view('pages.admin.ISPA.kepadatanPenduduk.index', compact('kepadatanPendudukIspa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ISPA.kepadatanPenduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil path file dari request
        $filePath = $request->file('file')->getRealPath();
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        // Cek apakah ada error pada JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }

        // Simpan gambar jika ada file gambar yang di-upload
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $banner = $request->file('gambar');
            $banner->storeAs('public/kepadatanPendudukIspa/', $banner->hashName());
            $gambar = $banner->hashName();
        }

        // Loop melalui fitur data
        foreach ($data['features'] as $feature) {
            $kpdt_bps_value = null;

            // Cari properti yang cocok dengan regex 'kpdt_bps' diikuti dengan 2 digit angka
            foreach ($feature['properties'] as $key => $value) {
                if (preg_match('/^kpdt_bps\d+$/', $key)) {
                    $kpdt_bps_value = $value; // Ambil nilai yang sesuai
                    break; // Berhenti di pencocokan pertama
                }
            }

            // Buat entri hanya jika ditemukan kpdt_bps yang cocok
            if ($kpdt_bps_value !== null) {
                KepadatanPendudukIspa::create([
                    'geometry' => json_encode($feature['geometry']),
                    'kecamatan' => $feature['properties']['KECAMATAN'],
                    'kpdt_bps' => $kpdt_bps_value,
                    'kelas_kpdt' => $feature['properties']['KELAS_KPDT'],
                    'operator' => $request->operator,
                    'tanggal' => $request->tanggal,
                    'gambar' => $gambar,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.kepadatan-penduduk-ispa.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KepadatanPendudukIspa $kepadatanPendudukIspa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KepadatanPendudukIspa $kepadatanPendudukIspa)
    {
        return view('pages.admin.ISPA.kepadatanPenduduk.edit', compact('kepadatanPendudukIspa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kepadatanPendudukIspa = KepadatanPendudukIspa::findOrFail($id);

        $request->validate([
            'geometry' => 'required|json',
        ]);

        $kepadatanPendudukIspa->update([
            'geometry' => $request->input('geometry'),
            'kecamatan' => $request->input('kecamatan'),
            'kpdt_bps' => $request->input('kpdt_bps'),
            'kelas_kpdt' => $request->input('kelas_kpdt'),
        ]);

        return redirect()->route('admin.kepadatan-penduduk-ispa.index')->with('success', 'Data Penyakit ISPA berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kepadatanPendudukIspa = KepadatanPendudukIspa::findOrFail($id);
        $allKepadatanPendudukIspa = KepadatanPendudukIspa::where('tanggal', $kepadatanPendudukIspa->tanggal)->get();
        if ($allKepadatanPendudukIspa->count() === 1 && $kepadatanPendudukIspa->gambar) {
            Storage::delete('public/kepadatanPendudukIspa/' . $kepadatanPendudukIspa->gambar);
        }
        // Hapus data kepadatanPendudukIspa
        $kepadatanPendudukIspa->delete();
        return redirect()->route('admin.kepadatan-penduduk-ispa.index')->with('success', 'Data Penyakit ISPA berhasil dihapus!');
    }
}
