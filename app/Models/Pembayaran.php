<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    public $timestamps = false;
    protected $fillable = ['nama_bayar'];

    public function TransJual()
    {
        return $this->hasMany(TransJual::class);
    }

    public function TransBeli()
    {
        return $this->hasMany(TransBeli::class);
    }

    public function Piutang()
    {
        return $this->hasMany(Piutang::class);
    }
}
