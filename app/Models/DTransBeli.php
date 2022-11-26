<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTransBeli extends Model
{

    protected $table = 'dtrans_beli';
    public $timestamps = false;
    protected $fillable = ['htrans_beli_id', 'barang_id', 'jumlah', 'harga', 'disc'];

    public function TransBeli()
    {
        return $this->belongsTo(TransBeli::class, 'htrans_beli_id', 'id');
    }

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
