<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPiutang extends Model
{
    use HasFactory;
    protected $table = 'd_piutang';
    public $timestamps = false;
    protected $fillable = ['h_piutang_id',
    'tgl_piutang',
    'total_bayar'];

    public function Piutang()
    {
        return $this->belongsTo(Piutang::class, 'h_piutang_id');
    }
}
