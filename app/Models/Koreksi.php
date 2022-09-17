<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koreksi extends Model
{
    use HasFactory;
    protected $table = 'koreksi';
    protected $fillable = ['barang_id', 'tgl_koreksi', 'jumlah', 'jenis', 'keterangan'];

    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
