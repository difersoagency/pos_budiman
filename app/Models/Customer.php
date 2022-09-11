<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'kode_customer';
    protected $fillable = ['kode_customer', 'kode_kota', 'nama_customer', 'alamat', 'telepon'];

    public function Kota()
    {
        return $this->belongsTo(Kota::class, 'kode_kota');
    }

    public function Booking()
    {
        return $this->hasMany(Booking::class, 'kode_customer');
    }
}
