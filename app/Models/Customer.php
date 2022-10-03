<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['kota_id', 'nama_customer', 'alamat', 'telepon'];
    public $timestamps = false;

    public function Kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }
}
