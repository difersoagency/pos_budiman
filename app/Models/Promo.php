<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $primaryKey = 'kode_promo';
    protected $fillable = ['kode_promo', 'tgl_mulai', 'tgl_selesai', 'nama_promo', 'kode_barang', 'qty_sk', 'disc'];

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang');
    }

    public function TransJual()
    {
        return $this->hasMany(TransJual::class, 'kode_promo');
    }
}
