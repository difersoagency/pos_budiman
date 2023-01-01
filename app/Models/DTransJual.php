<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTransJual extends Model
{
    use HasFactory;
    protected $table = 'dtrans_jual';
    public $timestamps = false;
    protected $fillable = ['htrans_jual_id', 'barang_id', 'promo_id', 'jumlah', 'harga', 'disc'];

    public function TransJual()
    {
        return $this->belongsTo(TransJual::class, 'htrans_jual_id');
    }

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function Promo()
    {
        return $this->belongsTo(Promo::class);
    }

}
