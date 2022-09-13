<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $fillable = ['kode_barang', 'kode_tipe', 'kode_merek', 'nama_barang', 'kode_satuan', 'stok', 'harga_beli', 'harga_jual'];

    public function Tipe()
    {
        return $this->belongsTo(Tipe::class, 'kode_tipe');
    }

    public function Merek()
    {
        return $this->belongsTo(Merek::class, 'kode_merek');
    }

    public function Satuan()
    {
        return $this->belongsTo(Satuan::class, 'kode_satuan');
    }

    public function Koreksi()
    {
        return $this->hasMany(Koreksi::class, 'kode_barang');
    }
    
}
