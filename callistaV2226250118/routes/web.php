<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('Profile');
});

//buat route ke halaman profile
Route::get('/dosen', function () {
    return view('dosen.dosen');
});


//pm wajib
Route::get('/mahasiswa/{nama?}', function ($nama = 'karay') {
   echo "<h2>Olaa epribadi, mi chiamo $nama</h2>";
});

//pm ga wajib
// Route::get('/mahasiswa/{nama?}', function ($nama = 'karay') {
//    echo "<h2>Olaa epribadi, mi chiamo $nama</h2>";
// });

//pm >1
Route::get('/mahasiswa/{nama?}/(pekerjaan?', function ($nama = 'karay', $pekerjaan = "Pilot") {
   echo "<h2>Olaa epribadi, mi chiamo $nama as a $pekerjaan</h2>";
});

//redirect
Route::get('/hubungi', function () {
   echo "<h1>Contact us</h2>";
});

Route::redirect('contact', '/hubungi');

Route::get('/halo', function () {
   echo "<a href='" . route('call') . "'>" . route('call') . "</a";
});

//route per modul
Route::prefix('/dosen')->group(function () {
    Route::get('/jadwal', function () {
         return "<h1>Jadwal<h1>";
    });

    Route::get('/materi', function(){
        return "<h1>Materi Perkuliahan<h2>";
    });
});

Route::get('/fakultas', function () {
    // return view('fakultas.index', ['ilkom' => 'Fakultas Ilmu Komputer dan Rekayasa']);
    // return view('fakultas.index', ['fakultas' => ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ekonomi dan Bisnis']]);
    // return view('fakultas.index')-> with('fakultas', ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ekonomi dan Bisnis']);
//    $fakultas= [];
    // $fakultas =  ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ekonomi dan Bisnis'];
    // return view('fakultas.index', compact('fakultas'));
   
    $kampus = "Universitas Multi Data Palembang";
    $fakultas = ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ekonomi dan Bisnis'];
    return view('fakultas.index', compact('fakultas','kampus'));
});


