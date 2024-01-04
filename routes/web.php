<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KonfigurasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:datasiswa'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin',[AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['auth:datasiswa'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/proseslog_out', [AuthController::class, 'proseslog_out']);

    //presensi
    Route::get('/presensi/create',[PresensiController::class,'create']);
    Route::post('/presensi/store',[PresensiController::class, 'store']);

    //edit Profile
    Route::get('/editprofile',[PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nisn}/updateprofile', [PresensiController::class, 'updateprofile']);


    //histori
    Route::get('/presensi/histori', [PresensiController::class,'histori']);
    Route::post('/gethistori', [PresensiController::class,'gethistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);

});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/panel/dashboardadmin',[DashboardController::class, 'dashboardadmin']);
    Route::get('/proseslog_outadmin', [AuthController::class, 'proseslog_outadmin']);

    //Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::post('/siswa/edit', [SiswaController::class, 'edit']);
    Route::post('/siswa/{nisn}/update', [SiswaController::class, 'update']);
    Route::post('/siswa/{nisn}/delete', [SiswaController::class, 'delete']);

    //wali
    Route::get('/wali', [WaliController::class, 'index']);
    Route::post('/wali/store', [WaliController::class, 'store']);
    Route::post('/wali/edit', [WaliController::class, 'edit']);
    Route::post('/wali/{kode_kelas}/update', [WaliController::class, 'update']);
    Route::post('/wali/{kode_kelas}/delete', [WaliController::class, 'delete']);


    //presensiMonitoring
    Route:: get('/presensi/monitoring',[PresensiController::class, 'monitoring']);
    Route:: post('/getpresensi',[PresensiController::class, 'getpresensi']);
    Route:: post('/tampilkanpeta',[PresensiController::class, 'tampilkanpeta']);
    Route:: get('/presensi/laporan',[PresensiController::class, 'laporan']);
    Route:: post('/presensi/cetaklaporan',[PresensiController::class, 'cetaklaporan']);
    Route:: get('/presensi/rekap',[PresensiController::class, 'rekap']);
    Route:: post('/presensi/cetakrekap',[PresensiController::class, 'cetakrekap']);
    Route:: get('/presensi/izinsakit',[PresensiController::class, 'izinsakit']);
    Route:: post('/presensi/approveizinsakit',[PresensiController::class, 'approveizinsakit']);
    Route:: get('/presensi/{id}/batalkanizinsakit',[PresensiController::class, 'batalkanizinsakit']);

    //KEGIATAN
    Route:: get('/kegiatan',[KegiatanController::class, 'index']);
    Route:: post('/kegiatan/store',[KegiatanController::class, 'store']);
    Route:: post('/kegiatan/edit',[KegiatanController::class, 'edit']);
    Route:: post('/kegiatan/update',[KegiatanController::class, 'update']);
    Route:: post('/kegiatan/{kode_kegiatan}/delete',[KegiatanController::class, 'delete']);


    //konfigurasi
    Route:: get('/konfigurasi/lokasisekolah',[KonfigurasiController::class, 'lokasisekolah']);
    Route:: post('/konfigurasi/updatelokasi',[KonfigurasiController::class, 'updatelokasi']);
    Route:: get('/konfigurasi/jamsekolah',[KonfigurasiController::class, 'jamsekolah']);
    Route:: post('/konfigurasi/storejamsekolah',[KonfigurasiController::class, 'storejamsekolah']);
    Route:: post('/konfigurasi/editjamsekolah',[KonfigurasiController::class, 'editjamsekolah']);
    Route:: post('/konfigurasi/updatejs',[KonfigurasiController::class, 'updatejs']);
    Route:: post('/konfigurasi/{kode_jam_sekolah}/delete',[KonfigurasiController::class, 'deletejamsekolah']);
    Route:: get('/konfigurasi/{nisn}/setjamsekolah',[KonfigurasiController::class, 'setjamsekolah']);
    Route:: post('/konfigurasi/storesetjamsekolah',[KonfigurasiController::class, 'storesetjamsekolah']);
    Route:: post('/konfigurasi/updatesetjamsekolah',[KonfigurasiController::class, 'updatesetjamsekolah']);



    Route:: get('/konfigurasi/jamkelas',[KonfigurasiController::class, 'jamkelas']);
    Route:: get('/konfigurasi/jamkelas/create',[KonfigurasiController::class, 'createjamkelas']);
    Route:: post('/konfigurasi/jamkelas/store',[KonfigurasiController::class, 'storejamkelas']);
});
