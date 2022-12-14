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
        return $this->hasMany(DTransJual::class);
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
}
