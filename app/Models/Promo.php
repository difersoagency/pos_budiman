<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $fillable = ['kode_promo', 'tgl_mulai', 'tgl_selesai', 'nama_promo', 'barang_id', 'jasa_id', 'qty_sk', 'disc'];
    public $timestamps = false;

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function Jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id');
    }

    public function DTransJual()
    {
        return $this->hasMany(DTransJual::class);
    }

    public function DTransJualJasa()
    {
        return $this->hasMany(DTransJualJasa::class, 'promo_id');
    }
}
