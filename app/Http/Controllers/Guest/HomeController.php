<?php

namespace App\Http\Controllers\Guest;

use App\Models\News;
use App\Models\KasusHiv;
use App\Models\SuhuIspa;
use App\Models\HotspotHiv;
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

class HomeController extends Controller
{
    public function news(Request $request)
    {
        $query = News::query();

        // Filter by search term
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->input('category'))) {
            $category = $request->input('category');
            $query->where('category', $category);
        }

        // Fetch filtered data
        $news = $query->get();

        return view('news', compact('news'));
    }

    public function DetailNews(string $id)
    {
        $news = News::find($id);
        $other = News::where('id', '!=', $id)->get();
        if ($news) {
            return view('detailNews', compact('news', 'other'));
        } else {
            abort(404, 'News Details Not Found');
        }
    }


    public function LandingPage(Request $request)
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

        return view('landingpage', compact(
            'penyakitDbd',
            'kepadatanDbd',
            'faktorDbd',
            'penyakitIspa',
            'kelembapanIspa',
            'curahHujanIspa',
            'suhuIspa',
            'kepadatanIspa',
            'kasusHiv',
            'hotspot',
            'lokasiRawanTunaSusila',
            'pendudukMiskin',
            'usiaProduktif',
            'tunaSusila',
            'wilayahRentan'
        ));
    }
}
