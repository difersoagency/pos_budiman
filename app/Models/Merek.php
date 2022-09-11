<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    use HasFactory;
    protected $table = 'merek';
    protected $primaryKey = 'kode_merek';
    protected $fillable = ['kode_merek', 'nama_merek'];

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'kode_merek');
    }
}
