<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransBeli extends Model
{
    use HasFactory;
    protected $table = 'htrans_beli';
    public $timestamps = false;
    protected $fillable = ['supplier_id', 'pembayaran_id', 'nomor_po', 'tgl_trans_beli', 'tgl_max_garansi', 'disc', 'total_bayar', 'total'];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function DTransBeli()
    {
        return $this->hasMany(DTransBeli::class, 'htrans_beli_id', 'id');
    }

    public function ReturBeli()
    {
        return $this->hasMany(ReturBeli::class);
    }
    public function TransHutang()
    {
        return $this->hasOne(TransHutang::class, 'htrans_beli_id', 'id');
    }
}
