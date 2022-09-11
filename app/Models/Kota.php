<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kota';
    protected $primaryKey = 'kode_kota';
    protected $fillable = ['kode_kota', 'nama_kota'];

    public function Customer()
    {
        return $this->hasMany(Customer::class, 'kode_kota');
    }

    public function Supplier()
    {
        return $this->hasMany(Supplier::class, 'kode_kota');
    }
}
