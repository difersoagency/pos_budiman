<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';
    protected $primaryKey = 'kode_jasa';
    protected $fillable = ['kode_jasa', 'nama_jasa'];

    public function TransJual()
    {
        return $this->hasMany(TransJual::class, 'kode_jasa');
    }

}
