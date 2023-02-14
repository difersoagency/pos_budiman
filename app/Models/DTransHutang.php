<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTransHutang extends Model
{
    use HasFactory;
    protected $table = 'd_hutang';
    protected $fillable = ['h_hutang_id', 'tgl_bayar', 'total_bayar', 'no_giro', 'tgl_jatuh_tempo', 'pembayaran_id'];
    public $timestamps = false;

    public function TransHutang()
    {
        return $this->belongsTo(TransHutang::class, 'h_hutang_id', 'id');
    }

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }
}
