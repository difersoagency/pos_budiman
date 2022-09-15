<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'kode_pegawai';
    protected $fillable = ['kode_pegawai', 'nama_pegawai'];

    public function User()
    {
        return $this->hasOne(User::class, 'kode_pegawai');
    }
}
