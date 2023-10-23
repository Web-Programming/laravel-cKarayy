<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

// jika nama tabel berbeda
    protected $table = "mahasiswas";

    //utk mengatur kolom yg boleh diisi saat mass assignment
    protected $fillable = ['npm' , 'nama','tempat_lahir', 'tanggal_lahir'];

    //utk mengatur kolom yg tdk boleh diisi
    protected $guarded = [];
}

