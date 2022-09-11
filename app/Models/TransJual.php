<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransJual extends Model
{
    use HasFactory;
    protected $table = 'htrans_jual';
    protected $primaryKey = 'no_trans_jual';
    protected $fillable = ['no_trans_jual', 'kode_promo', 'kode_jasa', 'kode_bayar', 'no_booking', 'tgl_trans_jual', 'total_jual', 'bayar_jual', 'kembali_jual', 'tgl_max_garansi'];

    public function Promo()
    {
        return $this->belongsTo(Promo::class, 'kode_promo');
    }

    public function Jasa()
    {
        return $this->belongsTo(Jasa::class, 'kode_jasa');
    }

    public function Booking()
    {
        return $this->belongsTo(Booking::class, 'no_booking');
    }
}
