<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    public $timestamps = false;

    protected $fillable = ['id_petugas','id_siswa','tgl_bayar','bulan_spp','tahun_spp'];
}
