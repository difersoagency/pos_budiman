<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelUser extends Model
{
    use HasFactory;
    protected $table = 'level_user';
    protected $fillable = ['kode_level', 'nama_level'];

    public function User()
    {
        return $this->hasMany(User::class);
    }

}
