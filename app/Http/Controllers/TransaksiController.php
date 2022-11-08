<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DTransBeli;
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

    public function store_beli(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tgl_beli' => 'required',
                'supplier' => 'required',
                'no_beli' => 'required',
                'tgl_beli_garansi' => 'required',
                'barang.*' => 'required',
                'jumlah_beli.*' => 'required',
                'harga_satuan.*' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {
            $header =  TransBeli::create([
                'supplier_id' => $request->supplier,
                'pembayaran_id' => 1,
                'nomor_po' => $request->no_beli,
                'tgl_trans_beli' => $request->tgl_beli,
                'tgl_max_garansi' => $request->tgl_beli_garansi,
                'disc' => $request->disc,
                'total_bayar' => '2222'
            ]);

            for ($i = 0; $i < count($request->barang); $i++) {
                DTransBeli::create([
                    'htrans_beli_id' => $header->id,
                    'barang_id' => $request->barang[$i],
                    'jumlah' => $request->jumlah_beli[$i],
                    'harga' => $request->harga_satuan[$i],
                    'disc' => '0'
                ]);
            }
            return response()->json(['data' => 'success']);
        }
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

    public function data_transaksi_beli()
    {
        $data = TransBeli::with('Supplier', 'Pembayaran')->orderBy('tgl_trans_beli', 'desc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('tgl_trans_beli', function ($data) {
                return  $data->tgl_trans_beli;
            })
            ->addColumn('tgl_max_garansi', function ($data) {
                return  $data->tgl_max_garansi;
            })
            ->addColumn('total_bayar', function ($data) {
                return  $data->nomor_po;
            })
            ->addColumn('nomor_po', function ($data) {
                return  $data->nomor_po;
            })
            ->addColumn('supplier', function ($data) {
                return  $data->Supplier->nama_supplier;
            })
            ->addColumn('pembayaran', function ($data) {
                return  $data->Pembayaran->nama_bayar;
            })
            ->addColumn('action', function ($data) {
                return '<div class="grid grid-cols-3 tw-contents">
                                                <a href="' . route('edit-beli', $data->id) . '" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pen tw-text-prim-blue"></i>
                                                </a>
                                                <button data-toggle="tooltip" title="Detail" class="tw-mr-4 tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-info tw-text-prim-black"></i>
                                                </button>
                                                <button data-toggle="tooltip" title="Hapus" class="tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                                </button>
                                            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function edit_beli($id)
    {
        $data = TransBeli::find($id);
        $supplier = Supplier::whereNotIN('id', [$data->supplier_id])->get();
        $barang = Barang::all();
        $satuan = Satuan::all();
        return view('layouts.transaksi.edit_beli', ['supplier' => $supplier, 'barang' => $barang, 'satuan' => $satuan, 'data' => $data]);
    }
}
