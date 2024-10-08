<?php

namespace App\Http\Controllers\Guest;

use App\Models\KasusHiv;
use App\Models\SuhuIspa;
use App\Models\HotspotHiv;
use App\Models\FaskesPdpHiv;
use Illuminate\Http\Request;
use App\Models\TunaSusilaHiv;
use App\Models\CurahHujanIspa;
use App\Models\KelembapanIspa;
use App\Models\DataPenyakitDbd;
use App\Models\DataPenyakitIspa;
use App\Models\WilayahRentanHiv;
use App\Models\PendudukMiskinHiv;
use App\Models\FaktorLingkunganDbd;
use App\Http\Controllers\Controller;
use App\Models\KepadatanPendudukDbd;
use App\Models\KepadatanPendudukIspa;
use App\Models\LokasiRawanTunaSusilaHiv;
use App\Models\PendudukPriaProduktivHiv;

class PetaController extends Controller
{

    public function index()
    {
        $kelurahanDbd = DataPenyakitDbd::pluck('kelurahan')->merge(
            FaktorLingkunganDbd::pluck('kelurahan')
        )->merge(
            KepadatanPendudukDbd::pluck('kelurahan')
        )->unique()->values(); 

        $kecamatanIspa = DataPenyakitIspa::pluck('kecamatan')->merge(
            CurahHujanIspa::pluck('kecamatan')
        )->merge(
            KelembapanIspa::pluck('kecamatan')
        )->merge(
            KepadatanPendudukIspa::pluck('kecamatan')
        )->merge(
            SuhuIspa::pluck('kecamatan')
        )->unique()->values();

        $kecamatanHiv = FaskesPdpHiv::pluck('kecamatan')->merge(
            HotspotHiv::pluck('kecamatan')
        )->merge(
            KasusHiv::pluck('kecamatan')
        )->merge(
            LokasiRawanTunaSusilaHiv::pluck('kecamatan')
        )->merge(
            PendudukMiskinHiv::pluck('kecamatan')
        )->merge(
            PendudukPriaProduktivHiv::pluck('kecamatan')
        )->merge(
            TunaSusilaHiv::pluck('kecamatan')
        )->merge(
            WilayahRentanHiv::pluck('kecamatan')
        )->unique()->values();

        return view('layouts.peta', [
            'wilayahDbd' => $kelurahanDbd,
            'wilayahIspa' => $kecamatanIspa,
            'wilayahHiv' => $kecamatanHiv
        ]);
    }

    public function filterPeta(Request $request)
{
    $tahun = $request->input('tahun');
    $bulan = $request->input('bulan');
    $jenisPenyakit = $request->input('jenis_penyakit');
    $wilayah = $request->input('wilayah');

    $filteredData = [];

    if ($jenisPenyakit == 'DBD') {
        $dataPenyakit = DataPenyakitDbd::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kelurahan', 'LIKE', "%$wilayah%")
            ->get();
        $faktorLingkungan = FaktorLingkunganDbd::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kelurahan', 'LIKE', "%$wilayah%")
            ->get();
        $kepadatanPenduduk = KepadatanPendudukDbd::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kelurahan', 'LIKE', "%$wilayah%")
            ->get();

        $filteredData = [
            'data_penyakit' => $dataPenyakit,
            'faktor_lingkungan' => $faktorLingkungan,
            'kepadatan_penduduk' => $kepadatanPenduduk
        ];
    } elseif ($jenisPenyakit == 'ISPA') {
        $dataPenyakit = DataPenyakitIspa::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $curahHujan = CurahHujanIspa::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $kelembapan = KelembapanIspa::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $suhu = SuhuIspa::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $kepadatanPenduduk = KepadatanPendudukIspa::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();

        $filteredData = [
            'data_penyakit' => $dataPenyakit,
            'curah_hujan' => $curahHujan,
            'kelembapan' => $kelembapan,
            'suhu' => $suhu,
            'kepadatan_penduduk' => $kepadatanPenduduk
        ];
    } elseif ($jenisPenyakit == 'HIV') {
        // Logika untuk filter data HIV
        $faskesPdp = FaskesPdpHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $hotspotHiv = HotspotHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $kasusHiv = KasusHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $lokasiRawan = LokasiRawanTunaSusilaHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $pendudukMiskin = PendudukMiskinHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $pendudukPriaProduktif = PendudukPriaProduktivHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $tunaSusila = TunaSusilaHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();
        $wilayahRentan = WilayahRentanHiv::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('kecamatan', 'LIKE', "%$wilayah%")
            ->get();

        $filteredData = [
            'faskes_pdp' => $faskesPdp,
            'hotspot_hiv' => $hotspotHiv,
            'kasus_hiv' => $kasusHiv,
            'lokasi_rawan' => $lokasiRawan,
            'penduduk_miskin' => $pendudukMiskin,
            'penduduk_pria_produktif' => $pendudukPriaProduktif,
            'tuna_susila' => $tunaSusila,
            'wilayah_rentan' => $wilayahRentan
        ];
    }

    // Kembalikan data dalam bentuk JSON
    return response()->json($filteredData);
}

}
