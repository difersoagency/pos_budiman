<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $table = 'satuan';
    protected $primaryKey = 'kode_satuan';
    protected $fillable = ['kode_satuan', 'nama_satuan'];

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'kode_satuan');
    }
}