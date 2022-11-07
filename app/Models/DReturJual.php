<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DReturJual extends Model
{
    use HasFactory;
    protected $table = 'dretur_jual';
    public $timestamps = false;
    protected $fillable = ['hretur_jual_id', 'barang_id', 'jumlah', 'harga'];

    public function Barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function ReturJual(){
        return $this->belongsTo(ReturJual::class, 'hretur_jual_id');
    }
}
