<?php

use App\Http\Controllers\Admin\FaktorLingkunganDbdController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\DataPenyakitDbdController;
use App\Http\Controllers\Admin\KepadatanPendudukDbdController;
use App\Http\Controllers\Admin\CurahHujanIspaController;
use App\Http\Controllers\Admin\DataPenyakitIspaController;
use App\Http\Controllers\Admin\KelembapanIspaController;
use App\Http\Controllers\Admin\SuhuIspaController;
use App\Http\Controllers\Admin\KepadatanPendudukIspaController;
use App\Http\Controllers\Admin\FaskesPdpHivController;
use App\Http\Controllers\Admin\HotspotHivController;
use App\Http\Controllers\Admin\KasusHivController;
use App\Http\Controllers\Admin\LokasiRawanTunaSusilaHivController;
use App\Http\Controllers\Admin\PendudukMiskinHivController;
use App\Http\Controllers\Admin\PendudukPriaProduktivHivController;
use App\Http\Controllers\Admin\TunaSusilaHivController;
use App\Http\Controllers\Admin\WilayahRentanHivController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Guest\PetaController;

Route::get('/', [HomeController::class, 'LandingPage'])->name('home');
Route::get('/artikel', [HomeController::class, 'news'])->name('home.artikel');
Route::get('/grafik', [GrafikController::class, 'graphic'])->name('home.grafik');
Route::get('/grafik/dbd', [GrafikController::class, 'kasusDbd'])->name('home.grafik.dbd');
Route::get('/grafik/hiv', [GrafikController::class, 'kasusHiv'])->name('home.grafik.hiv');
Route::get('/grafik/ispa', [GrafikController::class, 'kasusIspa'])->name('home.grafik.ispa');
Route::get('/artikel/{id}', [HomeController::class, 'DetailNews'])->name('home.artikel.detail');

Route::get('/peta', [PetaController::class, 'index'])->name('peta');  
Route::get('/peta/filter', [PetaController::class, 'filterPeta'])->name('peta.filter');  

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            // USER
            Route::resource('user', UserController::class);
            Route::get('/profile', [UserController::class, 'profile'])->name('profile');
            Route::put('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
            // DBD
            Route::resource('data-penyakit-dbd', DataPenyakitDbdController::class);
            Route::resource('kepadatan-penduduk-dbd', KepadatanPendudukDbdController::class);
            Route::resource('faktor-lingkungan-dbd', FaktorLingkunganDbdController::class);
            // ISPA
            Route::resource('curah-hujan-ispa', CurahHujanIspaController::class);
            Route::resource('kelembapan-ispa', KelembapanIspaController::class);
            Route::resource('suhu-ispa', SuhuIspaController::class);
            Route::resource('data-penyakit-ispa', DataPenyakitIspaController::class);
            Route::resource('kepadatan-penduduk-ispa', KepadatanPendudukIspaController::class);
            //HIV
            Route::resource('kasus-hiv', KasusHivController::class);
            Route::resource('hostpot-hiv', HotspotHivController::class);
            Route::resource('lokasi-rawan-tuna-susila-hiv', LokasiRawanTunaSusilaHivController::class);
            Route::resource('penduduk-miskin-hiv', PendudukMiskinHivController::class);
            Route::resource('penduduk-pria-usi-produktiv-hiv', PendudukPriaProduktivHivController::class);
            Route::resource('tuna-susila-hiv', TunaSusilaHivController::class);
            Route::resource('wilayah-rentan-hiv', WilayahRentanHivController::class);
            Route::resource('faskes-pdp-hiv', FaskesPdpHivController::class);
            //  NEWS
            Route::resource('news', NewsController::class);
            // CKEditor
            Route::post('/admin/upload-image', [NewsController::class, 'upload'])->name('upload.image');
            Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
                \UniSharp\LaravelFilemanager\Lfm::routes();
            });
        });
    });

require __DIR__ . '/auth.php';
