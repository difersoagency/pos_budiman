<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransHutang extends Model
{
    use HasFactory;
    protected $table = 'h_hutang';
    protected $fillable = ['pembayaran_id', 'trans_beli_id', 'tgl_hutang', 'total_hutang', 'bayar_hutang'];
    public $timestamps = false;

    public function TransBeli()
    {
        return $this->belongsTo(TransBeli::class);
    }
    public function DTransHutang()
    {
        return $this->hasMany(DTransHutang::class, 'h_hutang_id', 'id');
    }
    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }
}
