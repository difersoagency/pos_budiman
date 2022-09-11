<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koreksi extends Model
{
    use HasFactory;
    protected $table = 'koreksi';
    protected $primaryKey = 'no_koreksi';
    protected $fillable = ['no_koreksi', 'kode_barang', 'tgl_koreksi', 'jumlah', 'jenis', 'keterangan'];

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang');
    }
}
