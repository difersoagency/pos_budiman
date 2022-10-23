<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\TransBeli;
use App\Models\TransJual;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{


    public function tambah_jual()
    {
        return view('layouts.transaksi.tambah_jual');
    }

    public function transaksi_retur_jual()
    {
        return view('layouts.transaksi.retur-jual');
    }

    public function data_transaksi_retur_jual()
    {
    }

    public function tambah_retur_jual()
    {
        return view('layouts.transaksi.tambah_retur-jual');
    }

    public function transaksi_retur_beli()
    {
        return view('layouts.transaksi.retur-beli');
    }

    public function data_transaksi_retur_beli()
    {
    }

    public function tambah_retur_beli()
    {
        return view('layouts.transaksi.tambah_retur-beli');
    }
    public function master_hutang()
    {
        return view('layouts.transaksi.master-hutang');
    }
    public function master_piutang()
    {
        return view('layouts.transaksi.master-piutang');
    }
    public function bayar_hutang()
    {
        return view('layouts.transaksi.bayar-hutang');
    }
    public function bayar_piutang()
    {
        return view('layouts.transaksi.bayar-piutang');
    }

    public function transaksi_beli()
    {
        return view('layouts.transaksi.master-beli');
    }
    public function tambah_beli()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $satuan = Satuan::all();
        return view('layouts.transaksi.tambah_beli', ['supplier' => $supplier, 'barang' => $barang, 'satuan' => $satuan]);
    }

    public function transaksi_jual()
    {
        return view('layouts.transaksi.master-jual');
    }


    public function archive_trans()
    {
        return view('layouts.archive.archive-trans');
    }

    public function transaksi_store(Request $request)
    {
        TransBeli::create([
            'supplier_id' => $request->supplier,
            'pembayaran_id' => $request->pembayaran_id,
            'nomor_po' => $request->no_beli,
            'tgl_trans_beli' => $request->tgl_beli,
            'tgl_max_garansi' => $request->tgl_max_garansi,
            'disc' => $request->disc,
            'total_bayar' => $request->total_bayar,
        ]);
    }


    public function data_transaksi_jual()
    {
        $data = TransJual::with('Booking.Customer', 'Pembayaran')->orderBy('tgl_trans_jual', 'desc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
             <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_trans_jual . '" >
                                                     <i class="fa fa-pen tw-text-prim-blue"></i>
                                                 </button>
                                                 <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->no_trans_jual . '"
                                                     class="tw-bg-transparent tw-border-none">
                                                     <i class="fa fa-trash tw-text-prim-red"></i>
                                                 </button>
         </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
