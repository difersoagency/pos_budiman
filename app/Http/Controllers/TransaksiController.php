<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DBooking;
use App\Models\Barang;
use App\Models\DTransBeli;
use App\Models\Pembayaran;
use App\Models\Satuan;
use App\Models\Promo;
use App\Models\Supplier;
use App\Models\TransBeli;
use App\Models\DTransJualJasa;
use App\Models\DTransJual;
use App\Models\DPiutang;
use App\Models\DReturBeli;
use App\Models\DTransHutang;
use App\Models\TransJual;
use App\Models\Piutang;
use App\Models\ReturBeli;
use App\Models\ReturJual;
use App\Models\DReturJual;
use App\Models\TransHutang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class TransaksiController extends Controller
{
    public function transaksi_retur_jual()
    {
        return view('layouts.transaksi.retur-jual');
    }

    public function data_retur_jual()
    {
        $data = ReturJual::with('TransJual.Booking.Customer')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no_trans_jual', function ($data) {
                return $data->TransJual->no_trans_jual;
            })
            ->addColumn('customer', function ($data) {
                return $data->TransJual->Booking->Customer->nama_customer;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-3">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_retur_jual . '" >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>
                                                    <a href="/transaksi/retur-jual/edit/'.$data->id.'"><button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_retur_jual . '" >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button></a>
                                                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->no_retur_jual . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail_retur_jual($id)
    {
        $data = ReturJual::where('id', $id)->with('TransJual.Booking.Customer')->first();
        return view('layouts.modal.retur_jual-modal-detail', ['id' => $id, 'data' => $data]);
    }

    public function data_detail_retur_jual($id)
    {
        $data = DReturJual::where('hretur_jual_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('barang_id', function ($data) {
                return $data->Barang->nama_barang;
            })
            ->addColumn('subtotal', function ($data) {
                return $data->jumlah * $data->harga;
            })
            ->make(true);
    }

    public function tambah_retur_jual()
    {
        return view('layouts.transaksi.tambah_retur-jual');
    }

    public function store_retur_jual(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'htrans_jual_id' => ['required'],
            'no_retur_jual' => ['required', 'unique:hretur_jual,no_retur_jual'],
            'tgl_retur_jual' => ['required'],
            'total_retur_jual' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Gagal menambahkan, periksa kembali form anda");
        } else {
            $c = ReturJual::create([
                'htrans_jual_id' => $r->htrans_jual_id,
                'no_retur_jual' => $r->no_retur_jual,
                'tgl_retur_jual' => $r->tgl_retur_jual,
                'total_retur_jual' => str_replace(",", "", $r->total_retur_jual)
            ]);
            $bool = true;
            $dc = NULL;
            $jb = '';
            if ($c) {
                for ($i = 0; $i < count($r->barang_id); $i++) {
                    $dc = DReturJual::create([
                        'hretur_jual_id' => $c->id,
                        'barang_id' => $r->barang_id[$i],
                        'harga' => str_replace(",", "", $r->harga[$i]),
                        'jumlah' => $r->jumlah[$i]
                    ]);
                    if (!$dc) {
                        $bool = false;
                    } else {
                        $b = Barang::find($r->barang_id[$i]);
                        $b->stok = $b->stok + $r->jumlah[$i];
                        $b->save();
                    }
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali" . $r->jenis_brg[0]);
            }
        }
    }

    public function delete_retur_jual(Request $r){
        $drj = DReturJual::where('hretur_jual_id', $r->id)->count();
        if($drj > 0){
            $drjd = DReturJual::where('hretur_jual_id', $r->id)->delete();
        }
        $del = ReturJual::where('id', $r->id)->delete();
        if ($del) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function tambah_retur_beli()
    {
        return view('layouts.transaksi.tambah_retur-beli');
    }
    public function edit_retur_beli($id)
    {
        $data = ReturBeli::find($id);
        return view('layouts.transaksi.edit_retur-beli', ['data' => $data]);
    }
    public function master_hutang()
    {
        return view('layouts.transaksi.master-hutang');
    }
    public function master_piutang()
    {
        return view('layouts.transaksi.master-piutang');
    }
    public function data_piutang()
    {
        $data = Piutang::with('TransJual')->addSelect(['sum_total' => function ($q) {
            $q->selectRaw('coalesce(SUM(d_piutang.total_bayar), 0)')
                ->from('d_piutang')
                ->whereColumn('d_piutang.h_piutang_id', 'h_piutang.id');
        }])->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no_trans_jual', function ($data) {
                return $data->TransJual->no_trans_jual;
            })
            ->editColumn('sum_total', function ($data) {
                return strval($data->sum_total);
            })
            ->addColumn('sisa_hutang', function ($data) {
                return (float)$data->total_piutang - (float)$data->sum_total;
            })
            ->addColumn('action', function ($data) {
                $sisahutang = (float)$data->total_piutang - (float)$data->sum_total;
                $res = '<div class="grid grid-cols-3">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->id . '" >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>';
                if($sisahutang > 0){
                $res .= '<button id="btnbayar" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->id . '" >
                                                        <i class="fas fa-money-check-alt tw-text-prim-blue"></i>
                                                    </button>';
                }
                if($data->sum_total <= 0){
                $res .= '<button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->id . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>';
                }
            $res .= '</div>';
            return $res;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail_piutang($id)
    {
        $data = Piutang::where('id', $id)->with('TransJual.Booking.Customer')->first();
        return view('layouts.modal.piutang-modal-detail', ['id' => $id, 'data' => $data]);
    }
    public function detail_retur_beli($id)
    {
        $data = ReturBeli::find($id);
        return view('layouts.modal.retur-beli-modal-detail', ['data' => $data]);
    }

    public function data_detail_piutang($id)
    {
        $data = DPiutang::where('h_piutang_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function tambah_detail_piutang($id)
    {

        return view('layouts.modal.piutang-modal-create', ['id' => $id]);
    }

    public function delete_piutang(Request $r){
        $del = Piutang::where('id', $r->id)->delete();
        if ($del) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function update_hutang(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'tgl_beli.*' => 'required',
            'pembayaran_hutang.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {

            if (str_replace('.', "", $request->total_dibayar) > str_replace('.', "", $request->sisa_hutang)) {
                return response()->json(['data' => 'total_gagal']);
            } else {
                $tb = DTransHutang::where('h_hutang_id', $id)->get();
                if (count($tb) > 0) {
                    DTransHutang::where('h_hutang_id', $id)->delete();
                }

                for ($i = 0; $i < count($request->tgl_beli); $i++) {
                    DTransHutang::create([
                        'h_hutang_id' =>  $id,
                        'tgl_bayar' => $request->tgl_beli[$i],
                        'total_bayar' =>  str_replace('.', "", $request->pembayaran_hutang[$i]),
                    ]);
                }
                $trans_hutang  = TransHutang::find($id);
                $trans_hutang->bayar_hutang = str_replace('.', "", $request->total_dibayar);
                $trans_hutang->save();
                return response()->json(['data' => 'success']);
            }
        }
    }

    public function store_hutang(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'tgl_beli.*' => 'required',
            'pembayaran_hutang.*' => 'required',
            'beli_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {
            if (str_replace('.', "", $request->total_dibayar) > str_replace('.', "", $request->sisa_hutang)) {
                return response()->json(['data' => 'total_gagal']);
            } else {

                for ($i = 0; $i < count($request->tgl_beli); $i++) {
                    DTransHutang::create([
                        'h_hutang_id' =>  $request->hutang_id,
                        'tgl_bayar' => $request->tgl_beli[$i],
                        'total_bayar' =>  str_replace('.', "", $request->pembayaran_hutang[$i]),
                    ]);
                }

                $trans_hutang  = TransHutang::find($request->hutang_id);
                $trans_hutang->bayar_hutang = $trans_hutang->bayar_hutang + str_replace('.', "", $request->total_dibayar);
                $trans_hutang->save();
                return response()->json(['data' => 'success']);
            }
        }
    }

    public function store_detail_piutang(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'tgl_piutang' => ['required'],
            'total_bayar' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Gagal menambahkan, periksa kembali form anda");
        } else {
            $d = DPiutang::create([
                'h_piutang_id' => $id,
                'tgl_piutang' => $r->tgl_piutang,
                'total_bayar' => $r->total_bayar
            ]);

            if ($d) {
                return redirect()->back()->with('success', "Data berhasil disimpan");
            } else {
                return redirect()->back()->with('error', "Data gagal disimpan");
            }
        }
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
        $bayar = Pembayaran::all();
        return view('layouts.transaksi.tambah_beli', ['supplier' => $supplier, 'barang' => $barang, 'bayar' => $bayar]);
    }

    public function archive_trans()
    {
        return view('layouts.archive.archive-trans');
    }
    public function update_beli(Request $request, $id)
    {

        //dd($request);
        $validator = Validator::make($request->all(), [
            'tgl_beli' => 'required',
            'supplier' => 'required',
            'no_beli' => 'required|unique:htrans_beli,nomor_po,' . $id,
            'tgl_beli_garansi' => 'required',
            'total_bayar' => 'required',
            'total_dibayar' => 'required',
            'barang.*' => 'required',
            'jumlah_beli.*' => 'required',
            'harga_satuan.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {
            if (str_replace('.', "", $request->total_dibayar) > str_replace('.', "", $request->total_bayar)) {
                return response()->json(['data' => 'dibayar']);
            } else {
                $trans_beli = TransBeli::find($id);
                $trans_beli->supplier_id = $request->supplier;
                $trans_beli->pembayaran_id = $request->pembayaran_id;
                $trans_beli->nomor_po = $request->no_beli;
                $trans_beli->tgl_trans_beli = $request->tgl_beli;
                $trans_beli->tgl_max_garansi = $request->tgl_beli_garansi;
                $trans_beli->disc = $request->disc;
                $trans_beli->total_bayar = str_replace('.', "", $request->total_dibayar);
                $trans_beli->total = str_replace('.', "", $request->total_bayar);
                $trans_beli->save();




                $tb = DTransBeli::where('htrans_beli_id', $id)->get();


                if (count($tb) > 0) {
                    DTransBeli::where('htrans_beli_id', $id)->delete();
                }


                for ($i = 0; $i < count($request->barang); $i++) {
                    DTransBeli::create([
                        'htrans_beli_id' =>  $trans_beli->id,
                        'barang_id' => $request->barang[$i],
                        'jumlah' => $request->jumlah_beli[$i],
                        'harga' =>  str_replace('.', "", $request->harga_satuan[$i]),
                        'disc' => $request->diskon_beli[$i]
                    ]);
                }

                return response()->json(['data' => 'success']);
            }
        }
    }

    public function delete_retur_beli(Request $request)
    {



        $tb = DReturBeli::where('hretur_beli_id', $request->id)->get();

        if (count($tb) > 0) {
            DReturBeli::where('hretur_beli_id', $request->id)->delete();
        }

        $retur_beli =  ReturBeli::find($request->id)->delete();




        if ($retur_beli) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }
    public function update_retur_beli(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'tgl_retur_beli' => 'required',
                'barang_id.*' => 'required',
                'jumlah.*' => 'required',
                'harga.*' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {

            $retur_beli = ReturBeli::find($id);
            $retur_beli->tgl_retur_beli = $request->tgl_retur_beli;
            $retur_beli->total_retur_beli = str_replace('.', "", $request->total);
            $retur_beli->save();

            $tb = DReturBeli::where('hretur_beli_id', $id)->get();


            if (count($tb) > 0) {
                DReturBeli::where('hretur_beli_id', $id)->delete();
            }


            for ($i = 0; $i < count($request->barang_id); $i++) {
                DReturBeli::create([
                    'hretur_beli_id' =>  $id,
                    'barang_id' => $request->barang_id[$i],
                    'jumlah' => $request->jumlah[$i],
                    'harga' =>  str_replace('.', "", $request->harga[$i]),
                ]);
            }

            return response()->json(['data' => 'success']);
        }
    }
    public function store_retur_beli(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'no_po' => 'required',
                'tgl_retur_beli' => 'required',
                'barang_id.*' => 'required',
                'jumlah.*' => 'required',
                'harga.*' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {
            $h = ReturBeli::create([
                'htrans_beli_id' => $request->no_po,
                'tgl_retur_beli' => $request->tgl_retur_beli,
                'total_retur_beli' => str_replace('.', "", $request->total)
            ]);


            for ($i = 0; $i < count($request->barang_id); $i++) {
                DReturBeli::create([
                    'hretur_beli_id' =>  $h->id,
                    'barang_id' => $request->barang_id[$i],
                    'jumlah' => $request->jumlah[$i],
                    'harga' =>  str_replace('.', "", $request->harga[$i]),
                ]);
            }


            return response()->json(['data' => 'success']);
        }
    }

    public function store_beli(Request $request)
    {
        //dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'tgl_beli' => 'required',
                'supplier' => 'required',
                'no_beli' => 'required|unique:htrans_beli,nomor_po',
                'tgl_beli_garansi' => 'required',
                'total_bayar' => 'required',
                'total_dibayar' => 'required',
                'barang.*' => 'required',
                'jumlah_beli.*' => 'required',
                'harga_satuan.*' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['data' => 'error']);
        } else {
            if (str_replace('.', "", $request->total_dibayar) > str_replace('.', "", $request->total_bayar)) {
                return response()->json(['data' => 'dibayar']);
            } else {
                $header =  TransBeli::create([
                    'supplier_id' => $request->supplier,
                    'pembayaran_id' => $request->pembayaran_id,
                    'nomor_po' => $request->no_beli,
                    'tgl_trans_beli' => $request->tgl_beli,
                    'tgl_max_garansi' => $request->tgl_beli_garansi,
                    'disc' => $request->diskon_total,
                    'total_bayar' =>  str_replace('.', "", $request->total_dibayar),
                    'total' =>  str_replace('.', "", $request->total_bayar)
                ]);

                for ($i = 0; $i < count($request->barang); $i++) {
                    DTransBeli::create([
                        'htrans_beli_id' => $header->id,
                        'barang_id' => $request->barang[$i],
                        'jumlah' => $request->jumlah_beli[$i],
                        'harga' =>  str_replace('.', "", $request->harga_satuan[$i]),
                        'disc' => $request->diskon_beli[$i]
                    ]);
                }

                if (str_replace('.', "", $request->total_dibayar) != str_replace('.', "", $request->total_bayar)) {
                    TransHutang::create([
                        'pembayaran_id' => $request->pembayaran_id,
                        'htrans_beli_id' =>  $header->id,
                        'tgl_hutang' =>  $request->tgl_beli,
                        'total_hutang' => str_replace('.', "", $request->total_bayar) - str_replace('.', "", $request->total_dibayar),
                        'bayar_hutang' => 0
                    ]);
                }
                return response()->json(['data' => 'success']);
            }
        }
    }

    public function transaksi_jual()
    {
        return view('layouts.transaksi.master-jual');
    }
    public function detail_data_retur_beli($id)
    {
        $data = DReturBeli::where('hretur_beli_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('produk', function ($data) {
                return  $data->Barang->nama_barang;
            })
            ->addColumn('jumlah', function ($data) {
                return  $data->jumlah;
            })
            ->addColumn('harga', function ($data) {
                return number_format($data->harga);
            })
            ->addColumn('total', function ($data) {
                return  number_format($data->total_retur_beli * $data->jumlah);
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function data_retur_beli()
    {
        $data = ReturBeli::orderBy('tgl_retur_beli', 'desc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no_pembelian', function ($data) {
                return  $data->TransBeli->nomor_po;
            })
            ->addColumn('tgl_pembelian', function ($data) {
                return  $data->TransBeli->tgl_trans_beli;
            })
            ->addColumn('tgl_retur', function ($data) {
                return  $data->tgl_retur_beli;
            })
            ->addColumn('supplier', function ($data) {
                return  $data->TransBeli->Supplier->nama_supplier;
            })
            ->addColumn('total', function ($data) {
                return  number_format($data->total_retur_beli);
            })

            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '"  >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>
                <a id="btnedit" href="/transaksi/retur-beli/edit/' . $data->id . '" class="mr-4 tw-bg-transparent tw-border-none" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </a>
                                                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->TransBeli->nomor_po . '"
                                                            class="tw-bg-transparent tw-border-none">
                                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                                        </button>

            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function data_transaksi_jual()
    {
        $data = TransJual::with('Booking.Customer', 'Pembayaran', 'Piutang.DPiutang', 'ReturJual')->orderBy('tgl_trans_jual', 'desc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $res = '<div class="grid grid-cols-2">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_trans_jual . '" >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>';
                if(!isset($data->Piutang->DPiutang)){
                    if(count($data->ReturJual) <= 0){
                    $res .= '<a href="/transaksi/jual/edit/'.$data->id.'"><button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_trans_jual . '" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button></a>
                                                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->no_trans_jual . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>';}
                }
                $res .= '</div>';
                return $res;

            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail_data_hutang($id)
    {
        $data = DTransHutang::where('h_hutang_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('tgl_bayar', function ($data) {
                return  $data->tgl_bayar;
            })
            ->addColumn('total_bayar', function ($data) {
                return number_format(($data->total_bayar), 0, ',', '.');
            })
            ->make(true);
    }
    public function data_hutang()
    {
        $data = TransHutang::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no_pembelian', function ($data) {
                return  $data->TransBeli->nomor_po;
            })
            ->addColumn('supplier', function ($data) {
                return  $data->TransBeli->Supplier->nama_supplier;
            })
            ->addColumn('total_hutang', function ($data) {
                return  number_format($data->TransBeli->total - $data->TransBeli->total_bayar);
            })
            ->addColumn('lunas', function ($data) {
                return  number_format($data->bayar_hutang);
            })
            ->addColumn('sisa_hutang', function ($data) {
                return  number_format(($data->TransBeli->total - $data->TransBeli->total_bayar) - $data->bayar_hutang);
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '"  >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>
                <a id="btnedit" href="/transaksi/hutang/edit/' . $data->id . '" class="mr-4 tw-bg-transparent tw-border-none" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </a>

            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail_data_transaksi_beli($id)
    {
        $data = DTransBeli::where('htrans_beli_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('barang', function ($data) {
                return  $data->Barang->nama_barang;
            })
            ->addColumn('jumlah', function ($data) {
                return  $data->jumlah;
            })
            ->addColumn('harga', function ($data) {
                return number_format($data->harga, 0, ',', '.');
            })
            ->addColumn('disc', function ($data) {
                return  $data->disc . ' %';
            })
            ->addColumn('total', function ($data) {
                return number_format(($data->harga * $data->jumlah) - (($data->harga * $data->jumlah) * $data->disc / 100), 0, ',', '.');
            })
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
                return  number_format($data->total);
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
                                                <button data-toggle="tooltip" title="Detail"  data-id="' . $data->id . '" id="btndetail" class="tw-mr-4 tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-info tw-text-prim-black"></i>
                                                </button>
                                                <button data-nama="' . $data->nomor_po . '" data-id="' . $data->id . '" data-toggle="tooltip" title="Hapus" class="tw-bg-transparent tw-border-none" id="btndelete">
                                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                                </button>
                                            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete_beli(Request $request)
    {
        $dtb = DTransBeli::where('htrans_beli_id', $request->id)->get();
        if (count($dtb) > 0) {
            DTransBeli::where('htrans_beli_id', $request->id)->delete();
        }
        $tb = TransBeli::find($request->id)->delete();
        if ($tb) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function detail_beli($id)
    {
        $data = TransBeli::find($id);
        return view('layouts.modal.beli-modal-detail', ['data' => $data]);
    }

    public function edit_beli($id)
    {
        $data = TransBeli::find($id);
        $supplier = Supplier::all();
        $barang = Barang::all();
        $bayar = Pembayaran::all();
        return view('layouts.transaksi.edit_beli', ['supplier' => $supplier, 'barang' => $barang, 'bayar' => $bayar, 'data' => $data]);
    }
    public function detail_jual($id)
    {
        $data = TransJual::where('id', $id)->with('Booking.Customer')->first();
        return view('layouts.modal.jual-modal-detail', ['id' => $id, 'data' => $data]);
    }

    public function data_detail_jual($id)
    {
        $databrg = DTransJual::where('htrans_jual_id', $id)->addSelect(['nama' => function ($q) {
            $q->selectRaw('CONCAT(kode_barang, " - ", nama_merek, " ", nama_barang)')
                ->from('barang')
                ->join('merek', 'merek.id', '=', 'barang.merek_id')
                ->whereColumn('barang.id', 'dtrans_jual.barang_id');
        }])->select('jumlah', 'harga', 'disc')->get();

        $datajasa = DTransJualJasa::where('htrans_jual_id', $id)->addSelect(['nama' => function ($q) {
            $q->selectRaw('nama_jasa')
                ->from('jasa')
                ->whereColumn('jasa.id', 'dtrans_jual_jasa.jasa_id');
        }])->selectRaw('IF(id IS NULL, "", "1") as jumlah, harga, disc')->get();

        $data = $databrg->merge($datajasa);
        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function tambah_jual()
    {
        $date = Carbon::now()->toDateString();
        $promo = Promo::where('tgl_mulai', '<=', $date)->where('tgl_selesai', '>=', $date)->get();
        return view('layouts.transaksi.tambah_jual', ['promo' => $promo]);
    }

    public function store_jual(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'booking_id' => ['required'],
            'no_trans_jual' => ['required', 'unique:htrans_jual,no_trans_jual'],
            'tgl_trans_jual' => ['required'],
            'tgl_max_garansi' => ['required'],
            'total_jual' => ['required'],
            'bayar_jual' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Gagal menambahkan, periksa kembali form anda");
        } else {
            $c = TransJual::create([
                'booking_id' => $r->booking_id,
                'no_trans_jual' => $r->no_trans_jual,
                'tgl_trans_jual' => $r->tgl_trans_jual,
                'tgl_max_garansi' => $r->tgl_max_garansi,
                'total_jual' => str_replace(",", "", $r->total_jual),
                'bayar_jual' => str_replace(",", "", $r->bayar_jual),
                'kembali_jual' => str_replace(",", "", $r->kembali_jual),
                'promo_id' => $r->promo_id,
                'pembayaran_id' => $r->pembayaran_id,
            ]);
            $bool = true;
            $dc = NULL;
            $jb = '';
            if ($c) {
                for ($i = 0; $i < count($r->barang_id); $i++) {
                    if ($r->jenis_brg[$i] == "jasa") {
                        $dc = DTransJualJasa::create([
                            'htrans_jual_id' => $c->id,
                            'jasa_id' => $r->barang_id[$i],
                            'harga' => str_replace(",", "", $r->harga[$i]),
                            'disc' => $r->disc[$i]
                        ]);
                    } else if ($r->jenis_brg[$i] == "barang") {
                        $dc = DTransJual::create([
                            'htrans_jual_id' => $c->id,
                            'barang_id' => $r->barang_id[$i],
                            'harga' => str_replace(",", "", $r->harga[$i]),
                            'jumlah' => $r->jumlah[$i],
                            'disc' => $r->disc[$i]
                        ]);

                        $b = Barang::find($r->barang_id[$i]);
                        $b->stok = $b->stok - $r->jumlah[$i];
                        $b->save();
                    }
                    if (!$dc) {
                        $bool = false;
                    }
                }
                $byrjual = (float)str_replace(",", "", $r->bayar_jual);
                $totaljual = (float)str_replace(",", "", $r->total_jual);
                if ($byrjual < $totaljual) {
                    Piutang::create([
                        'htrans_jual_id' => $c->id,
                        'pembayaran_id' => $r->pembayaran_id,
                        'tgl_piutang' => $r->tgl_trans_jual,
                        'total_piutang' => $totaljual - $byrjual
                    ]);
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali" . $r->jenis_brg[0]);
            }
        }
    }

    public function delete_jual(Request $r){
        $pu = Piutang::where('htrans_jual_id', $r->id)->count();
        if($pu > 0){
            $pud = Piutang::where('htrans_jual_id', $r->id)->delete();
        }
        $dtjj = DTransJualJasa::where('htrans_jual_id', $r->id)->count();
        if($dtjj > 0){
            $dtjjd = DTransJualJasa::where('htrans_jual_id', $r->id)->delete();
        }
        $dtj = DTransJual::where('htrans_jual_id', $r->id)->count();
        if($dtj > 0){
            $dtjd = DTransJual::where('htrans_jual_id', $r->id)->delete();
        }
        $del = TransJual::where('id', $r->id)->delete();
        if ($del) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function detail_hutang($id)
    {
        $data = TransHutang::find($id);
        return view('layouts.modal.hutang-modal-detail', ['data' => $data]);
    }

    public function transaksi_retur_beli()
    {
        return view('layouts.transaksi.retur-beli');
    }

    public function data_transaksi_retur_beli()
    {
    }

    public function master_booking()
    {
        return view('layouts.transaksi.master_booking');
    }

    public function data_master_booking()
    {
        $data = Booking::with('Customer', 'TransJual')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('customer_nama', function ($data) {
                return $data->Customer->nama_customer;
            })
            ->addColumn('status', function ($data) {
                if ($data->TransJual != NULL) {
                    return '<span class="badge badge-success">Selesai</span>';
                } else {
                    return '<span class="badge badge-warning">Belum Proses</span>';
                }
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->no_booking . '" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button>
                                                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->no_booking . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
            </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function selectdata_hutang(Request $r, $id)
    {
        if ($id == 0) {
            $data = TransBeli::whereHas('TransHutang')->where('nomor_po', 'LIKE', '%' . $r->input('term', '') . '%')->select('id', 'nomor_po')->get();
            echo json_encode($data);
        } else {
            $data = TransBeli::find($id);
            echo json_encode([
                'hutang_id' => $data->TransHutang->id,
                'supplier' => $data->Supplier->nama_supplier,
                'total' =>  number_format($data->total, 0, ',', '.'),
                'tgl_transaksi' => $data->tgl_trans_beli,
                'sisa_hutang' =>  number_format(($data->total - $data->total_bayar) - $data->TransHutang->bayar_hutang, 0, ',', '.')
            ]);
        }
    }
    public function selectdata_beli(Request $r, $id)
    {
        if ($id == 0) {
            $data = TransBeli::where('nomor_po', 'LIKE', '%' . $r->input('term', '') . '%')->select('id', 'nomor_po')->get();
            echo json_encode($data);
        } else {
            $data = TransBeli::find($id);
            $tgl_trans_beli_short = Carbon::createFromFormat('Y-m-d', $data->tgl_trans_beli)->isoFormat('D MMMM Y');
            $tgl_max_garansi_short = Carbon::createFromFormat('Y-m-d', $data->tgl_max_garansi)->isoFormat('D MMMM Y');

            echo json_encode([
                'poid' => $data->id,
                'supplier' => $data->Supplier->nama_supplier,
                'alamat' => $data->Supplier->alamat,
                'telp' => $data->Supplier->telepon,
                'total' =>  number_format($data->total, 0, ',', '.'),
                'tgl_transaksi' => $tgl_trans_beli_short,
                'tgl_max_garansi' =>  $tgl_max_garansi_short
            ]);
        }
    }

    public function edit_hutang($id)

    {
        $data = TransHutang::find($id);
        return view('layouts.transaksi.edit-hutang', ['data' => $data]);
    }

    public function tambah_booking()
    {
        return view('layouts.transaksi.tambah_booking');
    }

    public function store_booking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'no_booking' => ['required', 'unique:booking,no_booking'],
            'tgl_booking' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Gagal menambahkan, periksa kembali form anda");
        } else {
            $c = Booking::create([
                'customer_id' => $request->customer_id,
                'no_booking' => $request->no_booking,
                'tgl_booking' => $request->tgl_booking
            ]);
            $bool = true;
            $dc = NULL;
            $jb = '';
            if ($c) {
                for ($i = 0; $i < count($request->barang_id); $i++) {
                    if ($request->jenis_brg[$i] == "jasa") {
                        $dc = DBooking::create([
                            'booking_id' => $c->id,
                            'barang_id' => NULL,
                            'jasa_id' => $request->barang_id[$i],
                            'jumlah' => $request->jumlah[$i]
                        ]);
                    } else if ($request->jenis_brg[$i] == "barang") {
                        $dc = DBooking::create([
                            'booking_id' => $c->id,
                            'jasa_id' => NULL,
                            'barang_id' => $request->barang_id[$i],
                            'jumlah' => $request->jumlah[$i]
                        ]);
                    }
                    if (!$dc) {
                        $bool = false;
                    }
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali");
            }
        }
    }
}
