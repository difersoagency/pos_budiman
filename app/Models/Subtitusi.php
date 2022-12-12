<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtitusi extends Model
{
    use HasFactory;
    protected $table = 'subtitusi';
    public $timestamps = false;
    protected $fillable = ['tgl_subtitusi', 'barang_id_1', 'barang_id_2'];

    public function Barang1()
    {
        return $this->belongsTo(Barang::class, 'barang_id_1');
    }

    public function Barang2()
    {
        return $this->belongsTo(Barang::class, 'barang_id_2');
    }
}
