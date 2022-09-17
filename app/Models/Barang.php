<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'tipe_id', 'merek_id', 'nama_barang', 'satuan_id', 'stok', 'harga_beli', 'harga_jual'];

    public function Tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    public function Merek()
    {
        return $this->belongsTo(Merek::class);
    }

    public function Satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function Koreksi()
    {
        return $this->hasMany(Koreksi::class);
    }
    
}
