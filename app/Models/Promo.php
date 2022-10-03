<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $fillable = ['kode_promo', 'tgl_mulai', 'tgl_selesai', 'nama_promo', 'barang_id', 'qty_sk', 'disc'];
    public $timestamps = false;

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function TransJual()
    {
        return $this->hasMany(TransJual::class);
    }
}
