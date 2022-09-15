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

    protected $primaryKey = 'kode_user';
    protected $fillable = [
        'kode_user',
        'kode_pegawai',
        'email',
        'password',
        'kode_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function LevelUser()
    {
        return $this->belongsTo(LevelUser::class, 'kode_level');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'kode_pegawai');
    }

    public function hasRole($role){
       $data = LevelUser::where('kode_level', $role)->limit(1);
       return $data->id;
    }
}
