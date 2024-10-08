<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurahHujanIspa;
use App\Models\DataPenyakitDbd;
use App\Models\DataPenyakitIspa;
use App\Models\FaktorLingkunganDbd;
use App\Models\HotspotHiv;
use App\Models\KasusHiv;
use App\Models\KelembapanIspa;
use App\Models\KepadatanPendudukDbd;
use App\Models\KepadatanPendudukIspa;
use App\Models\LokasiRawanTunaSusilaHiv;
use App\Models\PendudukMiskinHiv;
use App\Models\PendudukPriaProduktivHiv;
use App\Models\SuhuIspa;
use App\Models\TunaSusilaHiv;
use App\Models\WilayahRentanHiv;

class GrafikController extends Controller
{
   public function graphic()
    {
        $penyakitDbd = DataPenyakitDbd::latest('created_at')->first();
        $kepadatanDbd = KepadatanPendudukDbd::latest('created_at')->first();
        $faktorDbd = FaktorLingkunganDbd::latest('created_at')->first();

        $penyakitIspa = DataPenyakitIspa::latest('created_at')->first();
        $kelembapanIspa = KelembapanIspa::latest('created_at')->first();
        $curahHujanIspa = CurahHujanIspa::latest('created_at')->first();
        $suhuIspa = SuhuIspa::latest('created_at')->first();
        $kepadatanIspa = KepadatanPendudukIspa::latest('created_at')->first();

        $kasusHiv = KasusHiv::latest('created_at')->first();
        $hotspot = HotspotHiv::latest('created_at')->first();
        $lokasiRawanTunaSusila = LokasiRawanTunaSusilaHiv::latest('created_at')->first();
        $pendudukMiskin = PendudukMiskinHiv::latest('created_at')->first();
        $usiaProduktif = PendudukPriaProduktivHiv::latest('created_at')->first();
        $tunaSusila = TunaSusilaHiv::latest('created_at')->first();
        $wilayahRentan = WilayahRentanHiv::latest('created_at')->first();

       
        $latestRecord = collect([
            $penyakitDbd,
            $kepadatanDbd,
            $faktorDbd,
            $penyakitIspa,
            $kelembapanIspa,
            $curahHujanIspa,
            $suhuIspa,
            $kepadatanIspa,
            $kasusHiv,
            $hotspot,
            $lokasiRawanTunaSusila,
            $pendudukMiskin,
            $usiaProduktif,
            $tunaSusila,
            $wilayahRentan
        ])->filter()->sortByDesc('created_at')->first(); 

       
        if ($latestRecord) {
          
            $model = get_class($latestRecord);

            if ($latestRecord instanceof DataPenyakitDbd) {
                $allData = DataPenyakitDbd::all();
            } elseif ($latestRecord instanceof KepadatanPendudukDbd) {
                $allData = KepadatanPendudukDbd::all();
            } elseif ($latestRecord instanceof FaktorLingkunganDbd) {
                $allData = FaktorLingkunganDbd::all();
            } elseif ($latestRecord instanceof DataPenyakitIspa) {
                $allData = DataPenyakitIspa::all();
            } elseif ($latestRecord instanceof KelembapanIspa) {
                $allData = KelembapanIspa::all();
            } elseif ($latestRecord instanceof CurahHujanIspa) {
                $allData = CurahHujanIspa::all();
            } elseif ($latestRecord instanceof SuhuIspa) {
                $allData = SuhuIspa::all();
            } elseif ($latestRecord instanceof KepadatanPendudukIspa) {
                $allData = KepadatanPendudukIspa::all();
            } elseif ($latestRecord instanceof KasusHiv) {
                $allData = KasusHiv::all();
            } elseif ($latestRecord instanceof HotspotHiv) {
                $allData = HotspotHiv::all();
            } elseif ($latestRecord instanceof LokasiRawanTunaSusilaHiv) {
                $allData = LokasiRawanTunaSusilaHiv::all();
            } elseif ($latestRecord instanceof PendudukMiskinHiv) {
                $allData = PendudukMiskinHiv::all();
            } elseif ($latestRecord instanceof PendudukPriaProduktivHiv) {
                $allData = PendudukPriaProduktivHiv::all();
            } elseif ($latestRecord instanceof TunaSusilaHiv) {
                $allData = TunaSusilaHiv::all();
            } elseif ($latestRecord instanceof WilayahRentanHiv) {
                $allData = WilayahRentanHiv::all();
            } else {
                $allData = collect(); // Jika tidak ada record terbaru
            }

            $tableName = $model;
        } else {
           
            $allData = collect(); 
            $tableName = 'Tidak ada data terbaru';
        }

        return view('grafik', compact('allData', 'tableName'));
    }


    public function kasusDbd()
    {
        // Data DBD
        $dbdData = [
            'penyakit' => DataPenyakitDbd::all()->makeHidden('geometry'),
            'kepadatanPenduduk' => KepadatanPendudukDbd::all()->makeHidden('geometry'),
            'faktorLingkungan' => FaktorLingkunganDbd::all()->makeHidden('geometry'),
        ];

        return view('grafikDbd', [
            'dbdData' => $dbdData,
        ]);
    }

    public function kasusHiv()
    {
        // Data HIV
        $hivData = [
            'kasus' => KasusHiv::all()->makeHidden('geometry'),
            'hotspot' => HotspotHiv::all()->makeHidden('geometry'),
            'pendudukMiskin' => PendudukMiskinHiv::all()->makeHidden('geometry'),
            'usiaProduktif' => PendudukPriaProduktivHiv::all()->makeHidden('geometry'),
            'tunaSusila' => TunaSusilaHiv::all()->makeHidden('geometry'),
            'wilayahRentan' => WilayahRentanHiv::all()->makeHidden('geometry'),
        ];

        return view('grafikHiv', [
            'hivData' => $hivData,
        ]);
    }

    public function kasusIspa()
    {
        // Data ISPA
        $ispaData = [
            'penyakit' => DataPenyakitIspa::all()->makeHidden('geometry'),
            'kelembapan' => KelembapanIspa::all()->makeHidden('geometry'),
            'curahHujan' => CurahHujanIspa::all()->makeHidden('geometry'),
            'suhu' => SuhuIspa::all(),
            'kepadatanPenduduk' => KepadatanPendudukIspa::all()->makeHidden('geometry'),
        ];

        return view('grafikIspa', [
            'ispaData' => $ispaData,
        ]);
    }
}
