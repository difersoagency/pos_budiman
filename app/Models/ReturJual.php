<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturJual extends Model
{
    use HasFactory;
    protected $table = 'hretur_jual';
    public $timestamps = false;
    protected $fillable = ['htrans_jual_id', 'no_retur_jual', 'tgl_retur_jual', 'total_retur_jual'];

    public function TransJual(){
        return $this->belongsTo(TransJual::class, 'htrans_jual_id');
    }

    public function DReturJual(){
        return $this->hasMany(DReturJual::class, 'hretur_jual_id');
    }

    
}
