<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';
    public $timestamps = false;
    protected $fillable = ['nama_jasa', 'harga'];

    public function DTransJualJasa()
    {
        return $this->hasMany(DTransJualJasa::class);
    }

    public function DBooking()
    {
        return $this->hasMany(DBooking::class);
    }

}
