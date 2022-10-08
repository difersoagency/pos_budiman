<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DReturBeli extends Model
{
    use HasFactory;
    protected $table = 'dretur_beli';
    public $timestamps = false;
    protected $fillable = ['hretur_beli_id', 'barang_id', 'jumlah', 'harga'];

    public function Barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function ReturBeli(){
        return $this->belongsTo(ReturBeli::class, 'hretur_beli_id');
    }
}
