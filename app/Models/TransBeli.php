<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransBeli extends Model
{
    use HasFactory;
    protected $table = 'htrans_beli';
    public $timestamps = false;
    protected $fillable = ['supplier_id', 'pembayaran_id', 'nomor_po', 'tgl_trans_beli', 'tgl_max_garansi', 'disc', 'total_bayar'];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function DTransBeli()
    {
        return $this->hasMany(DTransBeli::class);
    }
}
