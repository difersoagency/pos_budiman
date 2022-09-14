<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'KODE_PEGAWAI';
    protected $fillable = ['KODE_PEGAWAI', 'NAMA_PEGAWAI'];

    public function User()
    {
        return $this->hasOne(User::class, 'KODE_PEGAWAI');
    }
}
