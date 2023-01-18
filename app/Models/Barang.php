<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'tipe_id', 'merek_id', 'nama_barang', 'satuan_id', 'stok', 'harga_beli', 'harga_jual'];
    public $timestamps = false;
    public function Tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id');
    }

    public function Merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }

    public function Satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function Koreksi()
    {
        return $this->hasMany(Koreksi::class);
    }
    public function Promo()
    {
        return $this->hasMany(Promo::class);
    }
    public function DTransJual()
    {
        return $this->hasMany(DTransJual::class, 'barang_id');
    }
    public function DTransBeli()
    {
        return $this->hasMany(DTransBeli::class, 'barang_id');
    }
    public function DReturJual()
    {
        return $this->hasMany(DReturJual::class);
    }
    public function DReturBeli()
    {
        return $this->hasMany(DReturBeli::class);
    }

    public function DBooking()
    {
        return $this->hasMany(DBooking::class);
    }

    public function Subtitusi1()
    {
        return $this->hasMany(Subtitusi::class, 'barang_id_1');
    }

    public function Subtitusi2()
    {
        return $this->hasMany(Subtitusi::class, 'barang_id_2');
    }
}
