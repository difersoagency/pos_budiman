<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransBeli extends Model
{
    use HasFactory;
    protected $table = 'htrans_beli';
    protected $primaryKey = 'no_trans_beli';
    protected $fillable = ['no_trans_beli', 'kd_supplier', 'kode_bayar', 'nomor_po', 'tgl_trans_beli', 'tgl_max_garansi', 'disc', 'total_bayar'];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'kd_supplier');
    }
}
