<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $primaryKey = 'no_booking';
    protected $fillable = ['no_booking', 'kode_customer', 'tgl_booking'];

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer');
    }

    public function TransJual()
    {
        return $this->hasMany(TransJual::class, 'no_booking');
    }
}
