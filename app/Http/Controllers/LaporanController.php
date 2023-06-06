<?php

namespace App\Http\Controllers;
use DB;
use App\Models\TransJual;
use App\Models\TransBeli;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualan;
use App\Exports\LaporanPembelian;
use App\Exports\LaporanPiutang;
use App\Exports\LaporanHutang;
use App\Exports\LaporanReturJual;
use App\Exports\LaporanReturBeli;
use App\Exports\LaporanLabaRugi;
use App\Exports\LaporanTopPenjualan;
use App\Exports\LaporanKartuStok;
use App\Exports\LaporanProduk;


class LaporanController extends Controller
{
    //mengarahkan user menuju halaman archive-laporan
    public function archive_laporan()
    {
        return view('layouts.archive.archive-laporan');
    }

    //mengarahkan user menuju halaman laporan laba-rugi
    public function laporan_laba_rugi()
    {
        return view('layouts.laporan.laba_rugi');
    }

    //mengarahkan user menuju halaman laporan pembelian
    public function laporan_pembelian()
    {
        return view('layouts.laporan.pembelian');
    }

    //mengarahkan user menuju halaman laporan penjualan
    public function laporan_penjualan()
    {
        return view('layouts.laporan.penjualan');
    }

    //mengarahkan user menuju halaman laporan retur beli
    public function laporan_retur_beli()
    {
        return view('layouts.laporan.retur_beli');
    }

    //mengarahkan user menuju halaman retur jual
    public function laporan_retur_jual()
    {
        return view('layouts.laporan.retur_jual');
    }

    //mengarahkan user menuju halaman laporan hutang
    public function laporan_hutang()
    {
        return view('layouts.laporan.hutang');
    }

    //mengarahkan user menuju halaman laporan piutang
    public function laporan_piutang()
    {
        return view('layouts.laporan.piutang');
    }

    //mengarahkan user menuju halaman laporan kartu stok
    public function laporan_kartu_stok()
    {
        return view('layouts.laporan.kartu_stok');
    }

    //mengarahkan user menuju halaman laporan top penjualan
    public function laporan_top_penjualan()
    {
        return view('layouts.laporan.top_penjualan');
    }

    //mengarahkan user menuju halaman laporan produk
    public function laporan_produk()
    {
        return view('layouts.laporan.produk');
    }

    // public function kasir()
    // {
    //     return view('kasir');
    // }
    
    //mendownload laporan laba rugi dalam excel 
    public function laporan_laba_rugi_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanLabaRugi($tgl_awal, $tgl_akhir), 'Laporan Laba Rugi.xlsx');
    }

    //mendownload laporan penjualan dalam excel
    public function laporan_penjualan_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanPenjualan($tgl_awal, $tgl_akhir), 'Laporan Penjualan.xlsx');
    }

    //mendownload laporan pembelian dalam excel
    public function laporan_pembelian_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanPembelian($tgl_awal, $tgl_akhir), 'Laporan Pembelian.xlsx');
    }

    //mendownload laporan piutang dalam excel
    public function laporan_piutang_data($customer, $tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanPiutang($customer, $tgl_awal, $tgl_akhir), 'Laporan Piutang.xlsx');
    }

    //mendownload laporan hutang dalam excel
    public function laporan_hutang_data($supplier, $tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanHutang($supplier, $tgl_awal, $tgl_akhir), 'Laporan Hutang.xlsx');
    }

    //mendownload laporan retur jual dalam excel
    public function laporan_retur_jual_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanReturJual($tgl_awal, $tgl_akhir), 'Laporan Retur Jual.xlsx');
    }

    //mendownload laporan retur beli dalam excel
    public function laporan_retur_beli_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanReturBeli($tgl_awal, $tgl_akhir), 'Laporan Retur Beli.xlsx');
    }

    //mendownload laporan top penjualan dalam excel
    public function laporan_top_penjualan_data($tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanTopPenjualan($tgl_awal, $tgl_akhir), 'Laporan Top Penjualan.xlsx');
    }

    //mendownload laporan kartu stok dalam excel
    public function laporan_kartu_stok_data($barang_id, $tgl_awal, $tgl_akhir){
        return Excel::download(new LaporanKartuStok($barang_id, $tgl_awal, $tgl_akhir), 'Laporan Kartu Stok.xlsx');
    }

    //mendownload laporan produk dalam excel
    public function laporan_produk_data(){
        return Excel::download(new LaporanProduk(), 'Laporan Produk.xlsx');
    }
    
    //mengambil seluruh data laba rugi untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_laba_rugi($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = TransBeli::with('Supplier', 'Pembayaran', 'ReturBeli')
                ->addSelect(['count_hutang'  => function ($q) { $q->selectRaw('coalesce(h_hutang.bayar_hutang,0)')
                    ->from('h_hutang')
                    ->whereColumn('h_hutang.htrans_beli_id', 'htrans_beli.id')
                    ->limit(1);
                }])->whereBetween('tgl_trans_beli', [$from, $to])->get();
        
        foreach($data as $i){
            $array[$count] = array(
            'tanggal' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_trans_beli)->format('d-m-Y'), 
            'nomor' => $i->nomor_po,
            'user' => $i->Supplier->nama_supplier,
            'total_jual' => 0,
            'total_beli' => $i->total);
            $count++;
        }

        $datas = TransJual::with('Booking.Customer', 'Piutang')->addSelect(['count_piutang' => function ($q) {
            $q->selectRaw('coalesce(SUM(total_bayar),0)')
            ->from('d_piutang')
            ->join('h_piutang', 'd_piutang.h_piutang_id', '=', 'h_piutang.id')
            ->whereColumn('h_piutang.htrans_jual_id', 'htrans_jual.id');
        }])->whereBetween('tgl_trans_jual', [$from, $to])
        ->get();
        
        foreach($datas as $i){
            $array[$count] = array(
            'tanggal' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_trans_jual)->format('d-m-Y'), 
            'nomor' => $i->no_trans_jual,
            'user' => $i->Booking->Customer->nama_customer,
            'total_jual' => $i->total_jual,
            'total_beli' => 0);
            $count++;
        }

        foreach ($array as $key => $row) {
            $tanggal[$key]  = $row['tanggal'];
        }

        $tanggal  = array_column($array, 'tanggal');

        array_multisort($tanggal, SORT_ASC, $array);
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data penjualan untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_penjualan($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = TransJual::with('Booking.Customer', 'Piutang')->addSelect(['count_piutang' => function ($q) {
            $q->selectRaw('coalesce(SUM(total_bayar),0)')
            ->from('d_piutang')
            ->join('h_piutang', 'd_piutang.h_piutang_id', '=', 'h_piutang.id')
            ->whereColumn('h_piutang.htrans_jual_id', 'htrans_jual.id');
        }])->whereBetween('tgl_trans_jual', [$from, $to])
        ->get();
        
        foreach($data as $key => $i){
            $array[$key] = array('tgl_trans_jual' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_trans_jual)->format('d-m-Y'), 
            'no_trans_jual' => $i->no_trans_jual,
            'tgl_max_garansi' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_max_garansi)->format('d-m-Y'), 
            'customer' => $i->Booking->Customer->nama_customer,
            'pembayaran' => $i->Pembayaran->nama_bayar,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '',
            'bayar_jual' => ($i->bayar_jual - $i->kembali_jual),
            'piutang_lunas' => $i->Piutang != NULL ? $i->count_piutang : "0",
            'sisa_piutang' => $i->Piutang != NULL ? ($i->total_jual -($i->count_piutang + $i->bayar_jual)) : "0",
            'total_jual' => $i->total_jual);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data pembelian untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_pembelian($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = TransBeli::with('Supplier', 'Pembayaran', 'ReturBeli')
                ->addSelect(['count_hutang'  => function ($q) { $q->selectRaw('coalesce(h_hutang.bayar_hutang,0)')
                    ->from('h_hutang')
                    ->whereColumn('h_hutang.htrans_beli_id', 'htrans_beli.id')
                    ->limit(1);
                }])->whereBetween('tgl_trans_beli', [$from, $to])->get();
        
        foreach($data as $key => $i){
            $array[$key] = array('tgl_trans_beli' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_trans_beli)->format('d-m-Y'), 
            'no_po' => $i->nomor_po,
            'tgl_max_garansi' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_max_garansi)->format('d-m-Y'), 
            'supplier' => $i->Supplier->nama_supplier,
            'pembayaran' => $i->Pembayaran->nama_bayar,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '',
            'bayar_beli' => ($i->total_bayar),
            'hutang_lunas' => $i->TransHutang != NULL ? $i->count_hutang : "0",
            'sisa_hutang' => $i->TransHutang != NULL ? ($i->total -($i->count_hutang + $i->total_bayar)) : "0",
            'total_beli' => $i->total);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data piutang untuk ditampilkan ke table (berdasarkan tanggal dan customer yang punya piutang)
    public function data_piutang($customer, $tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;

        //jika user ingin melihat data piutang dari customer tertentu
        if($customer != "0"){
            $data = DB::table('d_piutang')
                ->join('h_piutang', 'h_piutang.id', '=', 'd_piutang.h_piutang_id')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'h_piutang.htrans_jual_id')
                ->join('booking', 'booking.id', '=', 'htrans_jual.booking_id')
                ->join('customer', 'customer.id', '=', 'booking.customer_id')
                ->join('pembayaran', 'pembayaran.id', '=', 'd_piutang.pembayaran_id')
                ->whereBetween('d_piutang.tgl_piutang', [$from, $to])
                ->where('customer.id', $customer)
                ->select('htrans_jual.id as id_trans_jual',
                'htrans_jual.no_trans_jual as no_trans_jual',
                'customer.nama_customer as customer',
                'd_piutang.tgl_piutang as tgl_piutang',
                'pembayaran.nama_bayar as pembayaran',
                'd_piutang.no_giro as no_giro',
                'd_piutang.tgl_jatuh_tempo as tgl_jatuh_tempo',
                'd_piutang.total_bayar as total_bayar'
                )
                ->orderByRaw('htrans_jual.id ASC, d_piutang.tgl_piutang ASC')
                ->get();
        }
        //jika user ingin melihat data piutang dari semua customer
        else{
        $data = DB::table('d_piutang')
                ->join('h_piutang', 'h_piutang.id', '=', 'd_piutang.h_piutang_id')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'h_piutang.htrans_jual_id')
                ->join('booking', 'booking.id', '=', 'htrans_jual.booking_id')
                ->join('customer', 'customer.id', '=', 'booking.customer_id')
                ->join('pembayaran', 'pembayaran.id', '=', 'd_piutang.pembayaran_id')
                ->whereBetween('d_piutang.tgl_piutang', [$from, $to])
                ->select('htrans_jual.id as id_trans_jual',
                'htrans_jual.no_trans_jual as no_trans_jual',
                'customer.nama_customer as customer',
                'd_piutang.tgl_piutang as tgl_piutang',
                'pembayaran.nama_bayar as pembayaran',
                'd_piutang.no_giro as no_giro',
                'd_piutang.tgl_jatuh_tempo as tgl_jatuh_tempo',
                'd_piutang.total_bayar as total_bayar'
                )
                ->orderByRaw('htrans_jual.id ASC, d_piutang.tgl_piutang ASC')
                ->get();
        }
        foreach($data as $key => $i){
            $array[$key] = array(
            'no_trans_jual' => $i->no_trans_jual." (Customer: ".$i->customer.")",
            'tgl_bayar' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_piutang)->format('d-m-Y'), 
            'pembayaran' => $i->pembayaran,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '-',
            'total_bayar' => $i->total_bayar);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data hutang untuk ditampilkan ke table (berdasarkan tanggal & supplier dari pembelian)
    public function data_hutang($supplier, $tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = "";
        //jika user ingin melihat data hutang dari transaksi dengan supplier tertentu
        if($supplier != "0"){
            $data = DB::table('d_hutang')
            ->join('h_hutang', 'h_hutang.id', '=', 'd_hutang.h_hutang_id')
            ->join('htrans_beli', 'htrans_beli.id', '=', 'h_hutang.htrans_beli_id')
            ->join('supplier', 'supplier.id', '=', 'htrans_beli.supplier_id')
            ->join('pembayaran', 'pembayaran.id', '=', 'd_hutang.pembayaran_id')
            ->whereBetween('d_hutang.tgl_bayar', [$from, $to])
            ->where('supplier.id', $supplier)
            ->select('htrans_beli.id as id_trans_beli',
            'htrans_beli.nomor_po as no_po',
            'supplier.nama_supplier as supplier',
            'd_hutang.tgl_bayar as tgl_bayar',
            'pembayaran.nama_bayar as pembayaran',
            'd_hutang.no_giro as no_giro',
            'd_hutang.tgl_jatuh_tempo as tgl_jatuh_tempo',
            'd_hutang.total_bayar as total_bayar'
            )
            ->orderByRaw('htrans_beli.id ASC, d_hutang.tgl_bayar ASC')
            ->get();
        }
        //jika user ingin melihat seluruh data hutang
        else{
            $data = DB::table('d_hutang')
                ->join('h_hutang', 'h_hutang.id', '=', 'd_hutang.h_hutang_id')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'h_hutang.htrans_beli_id')
                ->join('supplier', 'supplier.id', '=', 'htrans_beli.supplier_id')
                ->join('pembayaran', 'pembayaran.id', '=', 'd_hutang.pembayaran_id')
                ->whereBetween('d_hutang.tgl_bayar', [$from, $to])
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as no_po',
                'supplier.nama_supplier as supplier',
                'd_hutang.tgl_bayar as tgl_bayar',
                'pembayaran.nama_bayar as pembayaran',
                'd_hutang.no_giro as no_giro',
                'd_hutang.tgl_jatuh_tempo as tgl_jatuh_tempo',
                'd_hutang.total_bayar as total_bayar'
                )
                ->orderByRaw('htrans_beli.id ASC, d_hutang.tgl_bayar ASC')
                ->get();
        }
        
        foreach($data as $key => $i){
            $array[$key] = array(
            'no_po' => $i->no_po." (Supplier: ".$i->supplier.")",
            'tgl_bayar' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_bayar)->format('d-m-Y'), 
            'pembayaran' => $i->pembayaran,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '-',
            'total_bayar' => $i->total_bayar);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data retur jual untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_retur_jual($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = DB::table('dretur_jual')
                ->join('hretur_jual', 'hretur_jual.id', '=', 'dretur_jual.hretur_jual_id')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'hretur_jual.htrans_jual_id')
                ->join('booking', 'booking.id', '=', 'htrans_jual.booking_id')
                ->join('customer', 'customer.id', '=', 'booking.customer_id')
                ->join('barang', 'barang.id', '=', 'dretur_jual.barang_id')
                ->whereBetween('hretur_jual.tgl_retur_jual', [$from, $to])
                ->select('htrans_jual.id as id_trans_jual',
                'htrans_jual.no_trans_jual as no_trans_jual',
                'customer.nama_customer as customer',
                'hretur_jual.no_retur_jual as no_retur_jual',
                'hretur_jual.tgl_retur_jual as tgl_retur_jual',
                'barang.nama_barang as barang',
                'dretur_jual.jumlah as jumlah',
                'dretur_jual.harga as harga'
                )
                ->orderByRaw('hretur_jual.tgl_retur_jual ASC, htrans_jual.id ASC')
                ->get();
        foreach($data as $key => $i){
            $array[$key] = array(
            'no_trans_jual' => "Penjualan: ".$i->no_trans_jual." (Customer: ".$i->customer.")",
            'no_retur_jual' => "Retur: ".$i->no_retur_jual." (Tanggal: ".\Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_retur_jual)->format('d-m-Y').")",
            'barang' => $i->barang,
            'jumlah' => $i->jumlah,
            'harga' => $i->harga,
            'total' => $i->jumlah * $i->harga);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data retur beli untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_retur_beli($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = DB::table('dretur_beli')
                ->join('hretur_beli', 'hretur_beli.id', '=', 'dretur_beli.hretur_beli_id')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'hretur_beli.htrans_beli_id')
                ->join('supplier', 'supplier.id', '=', 'htrans_beli.supplier_id')
                ->join('barang', 'barang.id', '=', 'dretur_beli.barang_id')
                ->whereBetween('hretur_beli.tgl_retur_beli', [$from, $to])
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as nomor_po',
                'supplier.nama_supplier as supplier',
                'hretur_beli.tgl_retur_beli as tgl_retur_beli',
                'barang.nama_barang as barang',
                'dretur_beli.jumlah as jumlah',
                'dretur_beli.harga as harga'
                )
                ->orderByRaw('hretur_beli.tgl_retur_beli ASC, htrans_beli.id ASC')
                ->get();
        foreach($data as $key => $i){
            $array[$key] = array(
            'no_po' => "Pembelian: ".$i->nomor_po." (Supplier: ".$i->supplier.")",
            'tgl_retur_beli' => "Tgl Retur: ".\Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_retur_beli)->format('d-m-Y'), 
            'barang' => $i->barang,
            'jumlah' => $i->jumlah,
            'harga' => $i->harga,
            'total' => $i->jumlah * $i->harga);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data top penjualan untuk ditampilkan ke table (berdasarkan tanggal)
    public function data_top_penjualan($tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data = DB::table('dtrans_jual')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
                ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
                ->join('merek', 'merek.id', '=', 'barang.merek_id')
                ->join('satuan', 'satuan.id', '=', 'barang.satuan_id')
                ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                ->selectRaw('barang.id as barang_id,
                barang.kode_barang as kode_barang,
                barang.nama_barang as nama_barang,
                SUM(dtrans_jual.jumlah) as jumlah'
                )
                ->orderByRaw('SUM(dtrans_jual.jumlah) DESC')
                ->groupByRaw('barang.id, barang.kode_barang, barang.nama_barang')
                ->get();
        foreach($data as $key => $i){
            $array[$key] = array(
            'kode' => $i->kode_barang,
            'nama' => $i->nama_barang,
            'jumlah' => $i->jumlah);
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data kartu stok untuk ditampilkan ke table (berdasarkan tanggal & barang yang ingin dilihat stoknya)
    public function data_kartu_stok($barang_id, $tgl_awal, $tgl_akhir){
        $from = date($tgl_awal);
        $to = date($tgl_akhir);
        $array = array();
        $count = 0;
        $data_jual = NULL;
        $data_beli = NULL;
        $data_koreksi = NULL;

        //melihat seluruh stok keluar dari penjualan
        if($barang_id == "0"){
            $data_jual = DB::table('dtrans_jual')
            ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
            ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
            ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
            ->select('htrans_jual.id as id_trans_jual',
            'htrans_jual.no_trans_jual as no_trans_jual',
            'htrans_jual.tgl_trans_jual as tgl_trans_jual',
            'barang.nama_barang as barang',
            'dtrans_jual.jumlah as jumlah',
            )
            ->orderByRaw('dtrans_jual.barang_id ASC, htrans_jual.id ASC')
            ->get();
        }else{
            $data_jual = DB::table('dtrans_jual')
                    ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
                    ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
                    ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                    ->where('barang.id', $barang_id)
                    ->select('htrans_jual.id as id_trans_jual',
                    'htrans_jual.no_trans_jual as no_trans_jual',
                    'htrans_jual.tgl_trans_jual as tgl_trans_jual',
                    'barang.nama_barang as barang',
                    'dtrans_jual.jumlah as jumlah',
                    )
                    ->orderByRaw('dtrans_jual.barang_id ASC, htrans_jual.id ASC')
                    ->get();
        }
        foreach($data_jual as $i){
            $array[$count] = array(
            'tgl_transaksi' => $i->tgl_trans_jual,
            'nomor' => $i->no_trans_jual,
            'barang' => $i->barang,
            'jenis' => 'Penjualan',
            'jumlah_masuk' => 0,
            'jumlah_keluar' => $i->jumlah);
            $count++;
        }

        //melihat seluruh stok masuk dari pembelian
        if($barang_id == "0"){
            $data_beli = DB::table('dtrans_beli')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'dtrans_beli.htrans_beli_id')
                ->join('barang', 'barang.id', '=', 'dtrans_beli.barang_id')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as nomor_po',
                'htrans_beli.tgl_trans_beli as tgl_trans_beli',
                'barang.nama_barang as barang',
                'dtrans_beli.jumlah as jumlah',
                )
                ->orderByRaw('dtrans_beli.barang_id ASC, htrans_beli.id ASC')
                ->get();
        }
        else{
            $data_beli = DB::table('dtrans_beli')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'dtrans_beli.htrans_beli_id')
                ->join('barang', 'barang.id', '=', 'dtrans_beli.barang_id')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->where('barang.id', $barang_id)
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as nomor_po',
                'htrans_beli.tgl_trans_beli as tgl_trans_beli',
                'barang.nama_barang as barang',
                'dtrans_beli.jumlah as jumlah',
                )
                ->orderByRaw('dtrans_beli.barang_id ASC, htrans_beli.id ASC')
                ->get();
        }
        foreach($data_beli as $i){
            $array[$count] = array(
                'tgl_transaksi' => $i->tgl_trans_beli,
                'nomor' => $i->nomor_po,
                'barang' => $i->barang,
                'jenis' => 'Pembelian',
                'jumlah_masuk' => $i->jumlah,
                'jumlah_keluar' => 0);
                $count++;
        }

        //melihat seluruh stok masuk dan keluar dari koreksi
        if($barang_id == "0")
        {
            $data_koreksi = DB::table('koreksi')
            ->join('barang', 'barang.id', '=', 'koreksi.barang_id')
            ->whereBetween('koreksi.tgl_koreksi', [$from, $to])
            ->select('koreksi.id as koreksi_id',
                    'koreksi.tgl_koreksi as tgl_koreksi',
                    'barang.nama_barang as barang',
                    'koreksi.jenis as jenis',
                    'koreksi.jumlah as jumlah',
                    )
            ->get();
        }else
        {
            $data_koreksi = DB::table('koreksi')
            ->join('barang', 'barang.id', '=', 'koreksi.barang_id')
            ->whereBetween('koreksi.tgl_koreksi', [$from, $to])
            ->where('barang.id', $barang_id)
            ->select('koreksi.id as koreksi_id',
                    'koreksi.tgl_koreksi as tgl_koreksi',
                    'barang.nama_barang as barang',
                    'koreksi.jenis as jenis',
                    'koreksi.jumlah as jumlah',
                    )
            ->get();
        }

        foreach($data_koreksi as $i){
            $array[$count] = array(
                'tgl_transaksi' => $i->tgl_koreksi,
                'nomor' => '',
                'barang' => $i->barang,
                'jenis' => 'Koreksi',
                'jumlah_masuk' => $i->jenis == 'in' ? $i->jumlah : 0,
                'jumlah_keluar' => $i->jenis != 'in' ? $i->jumlah : 0);
                $count++;
        }

        foreach ($array as $key => $row) {
            $tanggal[$key]  = $row['tgl_transaksi'];
        }

        $tanggal  = array_column($array, 'tgl_transaksi');

        array_multisort($tanggal, SORT_ASC, $array);
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data produk untuk ditampilkan ke table
    public function data_produk(){
        $array = array();
        $count = 0;
        $data = Barang::all();
        foreach($data as $key => $i){
            $array[$key] = array(
            'kode' => $i->kode_barang,
            'merek' => $i->Merek->nama_merek,
            'nama' => $i->nama_barang,
            'satuan' => $i->Satuan->nama_satuan,
            'stok' => $i->stok,
            'harga_beli' => $i->harga_beli,
            'harga_jual' => $i->harga_jual);
        }
        return response()->json(['data' => $array]);
    }

    //GRAFIK
    //mengambil seluruh data penjualan untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_penjualan(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        //jika bulan untuk mengambil data ditentukan oleh user
        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('htrans_jual')
                ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                ->selectRaw('htrans_jual.tgl_trans_jual as nama_barang,
                SUM(htrans_jual.total_jual) as jumlah'
                )
                ->groupByRaw('htrans_jual.tgl_trans_jual')
                ->get();
        }
        //jika user hanya ingin melihat berdasarkan tahun
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('htrans_jual')
                ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                ->selectRaw('MONTH(htrans_jual.tgl_trans_jual) as nama_barang,
                SUM(htrans_jual.total_jual) as jumlah'
                )
                ->groupByRaw('MONTH(htrans_jual.tgl_trans_jual)')
                ->get();
        }

        
        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $ket.$i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data pembelian untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_pembelian(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('htrans_beli')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->selectRaw('htrans_beli.tgl_trans_beli as nama_barang,
                SUM(htrans_beli.total) as jumlah'
                )
                ->groupByRaw('htrans_beli.tgl_trans_beli')
                ->get();
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('htrans_beli')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->selectRaw('MONTH(htrans_beli.tgl_trans_beli) as nama_barang,
                SUM(htrans_beli.total) as jumlah'
                )
                ->groupByRaw('MONTH(htrans_beli.tgl_trans_beli)')
                ->get();
        }

        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $ket.$i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data retur jual untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_retur_jual(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('hretur_jual')
                ->whereBetween('hretur_jual.tgl_retur_jual', [$from, $to])
                ->selectRaw('hretur_jual.tgl_retur_jual as nama_barang,
                SUM(hretur_jual.total_retur_jual) as jumlah'
                )
                ->groupByRaw('hretur_jual.tgl_retur_jual')
                ->get();
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('hretur_jual')
                ->whereBetween('hretur_jual.tgl_retur_jual', [$from, $to])
                ->selectRaw('MONTH(hretur_jual.tgl_retur_jual) as nama_barang,
                SUM(hretur_jual.total_retur_jual) as jumlah'
                )
                ->groupByRaw('MONTH(hretur_jual.tgl_retur_jual)')
                ->get();
        }

        
        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $ket.$i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data retur beli untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_retur_beli(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('hretur_beli')
                ->whereBetween('hretur_beli.tgl_retur_beli', [$from, $to])
                ->selectRaw('hretur_beli.tgl_retur_beli as nama_barang,
                SUM(hretur_beli.total_retur_beli) as jumlah'
                )
                ->groupByRaw('hretur_beli.tgl_retur_beli')
                ->get();
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('hretur_beli')
                ->whereBetween('hretur_beli.tgl_retur_beli', [$from, $to])
                ->selectRaw('MONTH(hretur_beli.tgl_retur_beli) as nama_barang,
                SUM(hretur_beli.total_retur_beli) as jumlah'
                )
                ->groupByRaw('MONTH(hretur_beli.tgl_retur_beli)')
                ->get();
        }

        
        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $ket.$i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data piutang untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_piutang(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('d_piutang')
                ->whereBetween('d_piutang.tgl_piutang', [$from, $to])
                ->selectRaw('d_piutang.tgl_piutang as nama_barang,
                SUM(d_piutang.total_bayar) as jumlah'
                )
                ->groupByRaw('d_piutang.tgl_piutang')
                ->get();
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('d_piutang')
                ->whereBetween('d_piutang.tgl_piutang', [$from, $to])
                ->selectRaw('MONTH(d_piutang.tgl_piutang) as nama_barang,
                SUM(d_piutang.total_bayar) as jumlah'
                )
                ->groupByRaw('MONTH(d_piutang.tgl_piutang)')
                ->get();
        }

        
        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $ket.$i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data hutang untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_hutang(Request $r){
        $data = array();
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';

            $data = DB::table('d_hutang')
                ->whereBetween('d_hutang.tgl_bayar', [$from, $to])
                ->selectRaw('d_hutang.tgl_bayar as nama_barang,
                  SUM(d_hutang.total_bayar) as jumlah')
                ->groupByRaw('d_hutang.tgl_bayar')
                ->get();
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';

            $data = DB::table('d_hutang')
                ->whereBetween('d_hutang.tgl_bayar', [$from, $to])
                ->selectRaw('MONTH(d_hutang.tgl_bayar) as nama_barang,
                  SUM(d_hutang.total_bayar) as jumlah')
                ->groupByRaw('MONTH(d_hutang.tgl_bayar)')
                ->get();
        }

        $array = array('nama' => array(), 'jumlah' => array());
        foreach($data as $key => $i){
            $array['nama'][$key] = $i->nama_barang;
            $array['jumlah'][$key] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }

    //mengambil seluruh data laba rugi untuk ditampilkan ke grafik (berdasarkan tanggal / tahun)
    public function grafik_laba_rugi(Request $r){
        $bulan = $r->bulan;
        $tahun = $r->tahun;

        if($bulan !== "0"){
            $ket = "";
            $from = $tahun.'-'.$bulan.'-01';
            $to = $tahun.'-'.$bulan.'-31';
        }
        else{
            $ket = "Bulan ";
            $from = $tahun.'-01-01';
            $to = $tahun.'-12-31';
        }

        $laba = DB::table('htrans_jual')
                ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                ->selectRaw('SUM(htrans_jual.total_jual) as jumlah')
                ->get();
        $array = array('nama' => array(), 'jumlah' => array());
        $array['nama'][0] = "Pemasukan";
        $array['jumlah'][0] = 0;
        foreach($laba as $key => $i){
            $array['nama'][0] = "Pemasukan";
            $array['jumlah'][0] = $i->jumlah;
        }

        $rugi = DB::table('htrans_beli')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->selectRaw('SUM(htrans_beli.total) as jumlah')
                ->get();
        $array['nama'][1] = "Pengeluaran";
        $array['jumlah'][1] = $i->jumlah;
        foreach($rugi as $key => $i){
            $array['nama'][1] = "Pengeluaran";
            $array['jumlah'][1] = $i->jumlah;
        }
        return response()->json(['data' => $array]);
    }
}
