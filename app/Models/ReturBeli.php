<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturBeli extends Model
{
    use HasFactory;
    protected $table = 'hretur_beli';
    public $timestamps = false;
    protected $fillable = ['htrans_beli_id', 'tgl_retur_beli', 'total_retur_beli'];

    public function TransBeli(){
        return $this->belongsTo(TransBeli::class, 'htrans_beli_id');
    }

    public function DReturBeli(){
        return $this->hasMany(DReturBeli::class, 'hretur_beli_id');
    }
}
