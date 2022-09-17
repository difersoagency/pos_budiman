<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    use HasFactory;
    protected $table = 'tipe';
    protected $fillable = ['kode_tipe', 'nama_tipe'];

    public function Barang()
    {
        return $this->hasMany(Barang::class);
    }
}
