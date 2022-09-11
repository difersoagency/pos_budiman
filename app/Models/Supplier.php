<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'kd_supplier';
    protected $fillable = ['kd_supplier', 'kode_kota', 'nama_supplier', 'alamat_supplier', 'telepon_supplier'];

    public function Kota()
    {
        return $this->belongsTo(Kota::class, 'kode_kota');
    }

    public function TransBeli()
    {
        return $this->hasMany(TransBeli::class, 'kd_supplier');
    }
}
