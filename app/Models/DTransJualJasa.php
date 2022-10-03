<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTransJualJasa extends Model
{
    use HasFactory;
    protected $table = 'dtrans_jual_jasa';
    public $timestamps = false;
    protected $fillable = ['htrans_jual_id', 'jasa_id', 'harga', 'disc'];

    public function TransJual()
    {
        return $this->belongsTo(TransJual::class);
    }

    public function Jasa()
    {
        return $this->belongsTo(Jasa::class);
    }
}
