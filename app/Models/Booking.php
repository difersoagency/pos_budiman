<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = ['no_booking', 'customer_id', 'tgl_booking'];
    public $timestamps = false;

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function TransJual()
    {
        return $this->hasMany(TransJual::class);
    }

    public function DBooking()
    {
        return $this->hasMany(DBooking::class);
    }
}
