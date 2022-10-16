<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBooking extends Model
{
    use HasFactory;
    protected $table = 'd_booking';
    protected $fillable = ['booking_id', 'barang_id', 'jasa_id', 'jumlah'];
    public $timestamps = false;

    public function Booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function Jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id');
    }

    
}
