<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    public $timestamps = false;
    protected $fillable = ['kode_pegawai', 'nama_pegawai', 'gender', 'telepon'];

    public function User()
    {
        return $this->hasOne(User::class);
    }
}
