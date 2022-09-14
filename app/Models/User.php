<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';

    protected $primaryKey = 'KODE_USER';
    protected $fillable = [
        'KODE_USER',
        'KODE_PEGAWAI',
        'EMAIL',
        'password',
        'KODE_LEVEL',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'REMEMBER_TOKEN',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'EMAIL_VERIFIED_AT' => 'datetime',
    ];

    public function LevelUser()
    {
        return $this->belongsTo(LevelUser::class, 'KODE_LEVEL');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'KODE_PEGAWAI');
    }

    public function hasRole($role){
       $data = LevelUser::where('KODE_LEVEL', $role)->limit(1);
       return $data->id;
    }
}
