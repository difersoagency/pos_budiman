<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    public $timestamps = false;
    protected $fillable = ['kota_id', 'nama_supplier', 'alamat', 'telepon'];

    public function Kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function TransBeli()
    {
        return $this->hasMany(TransBeli::class);
    }
}
