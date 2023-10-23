<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function insertElq(){
        //single assignment
        // $mhs = new Mahasiswa();
        // $mhs->nama = "Callista Virginia";
        // $mhs->npm = "2226250118";
        // $mhs->tempat_lahir = "Dunia";
        // $mhs->tanggal_lahir = date("Y-m-d"); //tgl hari ini
        // $mhs-> save();
        // dump($mhs);

        //mass Assignment
        $mhs = Mahasiswa::insert(
        [
            ['nama' => 'Callista Virginia',
            'npm' => '2226250118',
            'tempat_lahir' => 'Dunia',
            'tanggal_lahir' => '2004-08-24'
            ],
            ['nama' => 'Christin Virginia',
            'npm' => '2226250000',
            'tempat_lahir' => 'Bumi',
            'tanggal_lahir' => '2004-08-20'
            ]
        ]);
        dump($mhs);
    }

    public function updateElq(){
        $mhs = Mahasiswa::where('npm','2226250118')-> first();
        $mhs->nama = 'Charlotte Karay';
        $mhs->save();
        dump($mhs);
    }

    public function deleteElq(){
        $mhs = Mahasiswa::where('npm','2226250118')-> first();
        $mhs->delete();
        dump($mhs);
    }

    public function selectElq(){
        $kampus = "Universitas Multi Data Palembang";
        $mhs = Mahasiswa::all();
        // dump($allmhs);
        return view('mahasiswa.index',['allmahasiswa' => $mhs,'kampus'=> $kampus]);
    }


}
