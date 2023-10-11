<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    public $timestamps = false;

    protected $fillable = ['nisn','nis','nama','alamat','no_telp','id_kelas'];
}
