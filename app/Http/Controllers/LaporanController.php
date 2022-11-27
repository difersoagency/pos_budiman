<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function archive_laporan()
    {
        return view('layouts.archive.archive-laporan');
    }

    public function laporan_keuangan()
    {
        return view('layouts.laporan.keuangan');
    }

    public function laporan_pembelian()
    {
        return view('layouts.laporan.pembelian');
    }

    public function laporan_penjualan()
    {
        return view('layouts.laporan.penjualan');
    }


    public function laporan_produk()
    {
        return view('layouts.laporan.produk');
    }
}
