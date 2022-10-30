<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;
    protected $table = 'h_piutang';
    public $timestamps = false;
    protected $fillable = ['htrans_jual_id',
    'pembayaran_id',
    'tgl_piutang',
    'total_piutang'];

    public function TransJual()
    {
        return $this->belongsTo(TransJual::class, 'htrans_jual_id');
    }

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function DPiutang()
    {
        return $this->hasMany(DPiutang::class, 'h_piutang_id');
    }

    
}
