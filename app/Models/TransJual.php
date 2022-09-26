<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransJual extends Model
{
    use HasFactory;
    protected $table = 'htrans_jual';
    protected $primaryKey = 'no_trans_jual';
    protected $fillable = ['no_trans_jual', 'promo_id', 'jasa_id', 'bayar_id', 'booking_id', 'tgl_trans_jual', 'total_jual', 'bayar_jual', 'kembali_jual', 'tgl_max_garansi'];

    public function Promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function Booking()
    {
        return $this->belongsTo(Booking::class, 'no_booking');
    }
}
