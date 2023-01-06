<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kota';
    protected $fillable = ['nama_kota'];

    public function Customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function Supplier()
    {
        return $this->hasMany(Supplier::class);
    }
}
