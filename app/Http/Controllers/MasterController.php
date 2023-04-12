<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Koreksi;
use App\Models\Subtitusi;
use App\Models\Pembayaran;

use App\Models\Pegawai;
use App\Models\LevelUser;
use App\Models\Kota;
use App\Models\Merek;
use App\Models\Promo;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\Tipe;
use App\Models\TransBeli;
use App\Models\TransHutang;
use App\Models\DTransBeli;
use App\Models\User;
use App\Models\TransJual;
use App\Models\DTransJual;
use App\Models\DPiutang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MasterController extends Controller
{   
    public function all_jatuh_tempo(){
        $data = array();
        $c = 0;

        $jual = TransJual::with('Booking.Customer')
                ->whereBetween('tgl_jatuh_tempo', [Carbon::now(), Carbon::now()->addDays(7)])->whereNotNull('tgl_jatuh_tempo')
                ->get();

        foreach($jual as $i){
                $data[$c] = array('tgl_transaksi' => $i->tgl_trans_jual,
                                        'nomor' => $i->no_trans_jual,
                                        'jenis' => 'jual',
                                        'user' => 'Customer: '.$i->booking->customer->nama_customer,
                                        'total' => 'Total: '.number_format($i->total_jual),
                                        'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo);
                $c++;
        }

        $beli = TransBeli::with('Supplier', 'Pembayaran', 'ReturBeli')->whereBetween('tgl_jatuh_tempo', [Carbon::now(), Carbon::now()->addDays(7)])->whereNotNull('tgl_jatuh_tempo')
                ->get();

        foreach($beli as $i){
                        $data[$c] = array('tgl_trans_beli' => $i->tgl_trans_beli, 
                        'tgl_transaksi' => $i->tgl_trans_beli, 
                        'jenis' => 'beli',
                        'total' => 'Total: '.number_format($i->total), 
                        'nomor' => $i->nomor_po, 
                        'user' => 'Supplier: '.$i->Supplier->nama_supplier,
                        'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo);
                        $c++;
        }

        return response()->json(['notif' => $data]);
    }
    public function jual_dashboard(){
        $data = TransJual::with('Booking.Customer')->addSelect(['count_piutang' => function ($q) {
            $q->selectRaw('coalesce(SUM(total_bayar),0)')
            ->from('d_piutang')
            ->join('h_piutang', 'd_piutang.h_piutang_id', '=', 'h_piutang.id')
            ->whereColumn('h_piutang.htrans_jual_id', 'htrans_jual.id');
        }])->whereDate('tgl_jatuh_tempo', '>=', date('Y-m-d'))->whereNotNull('tgl_jatuh_tempo')
        ->get();
       
        $array = array();
        $c = 0;
        foreach($data as $i){
            if(($i->count_piutang + ($i->bayar_jual - $i->kembali_jual)) < $i->total_jual){
                $array[$c] = array('id' => $i->id,
                                        'tgl_trans_jual' => $i->tgl_trans_jual,
                                        'no_trans_jual' => $i->no_trans_jual,
                                        'customer' => $i->booking->customer->nama_customer,
                                        'total_jual' => $i->total_jual,
                                        'pembayaran' => $i->Pembayaran->nama_bayar,
                                        'no_giro' => $i->no_giro,
                                        'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo);
                $c++;
            }
        }


        return datatables()->of($array)
            ->addIndexColumn()
            ->addColumn('tgl_trans_jual', function($data){
                return $data['tgl_trans_jual'];
            })
            ->addColumn('no_trans_jual', function($data){
                return $data['no_trans_jual'];
            })
            ->addColumn('customer', function($data){
                return $data['customer'];
            })
            ->addColumn('total_jual', function($data){
                return $data['total_jual'];
            })
            ->addColumn('pembayaran', function($data){
                return $data['pembayaran'].'<div><small class="text-danger">Nomor: '.$data['no_giro'].'</small></div>';
            })
            ->addColumn('tgl_jatuh_tempo', function($data){
                return $data['tgl_jatuh_tempo'];
            })
            ->rawColumns(['pembayaran'])
            ->make(true);
    }

    public function beli_dashboard(){
        $data = TransBeli::with('Supplier', 'Pembayaran', 'ReturBeli')->whereDate('tgl_jatuh_tempo', '>=', date('Y-m-d'))->whereNotNull('tgl_jatuh_tempo')
                ->addSelect(['count_hutang'  => function ($q) { $q->selectRaw('coalesce(h_hutang.bayar_hutang,0)')
                    ->from('h_hutang')
                    ->whereColumn('h_hutang.htrans_beli_id', 'htrans_beli.id')
                    ->limit(1);
                }])->get();
        $array = array();
        $c = 0;
        foreach($data as $i){
            if(($i->count_hutang + $i->total_bayar) < $i->total){
                $array[$c] = array('tgl_trans_beli' => $i->tgl_trans_beli, 
                'tgl_max_garansi' => $i->tgl_max_garansi, 
                'total' => number_format($i->total), 
                'nomor_po' => $i->nomor_po, 
                'supplier' => $i->Supplier->nama_supplier, 
                'pembayaran' => $i->Pembayaran->nama_bayar, 
                'no_giro' => $i->no_giro, 
                'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo);
                $c++;
            }
        }
        return datatables()->of($array)
            ->addIndexColumn()
            ->addColumn('tgl_trans_beli', function ($data) {
                return  $data['tgl_trans_beli'];
            })
            ->addColumn('tgl_max_garansi', function ($data) {
                return  $data['tgl_max_garansi'];
            })
            ->addColumn('total_bayar', function ($data) {
                return  $data['total'];
            })
            ->editColumn('nomor_po', function ($data) {
                return  $data['nomor_po'];
            })
            ->addColumn('supplier', function ($data) {
                return  $data['supplier'];
            })
            ->addColumn('pembayaran', function ($data) {
                return $data['pembayaran'].'<div><small class="text-danger">Nomor: '.$data['no_giro'].'</small></div>';
            })
            ->addColumn('tgl_jatuh_tempo', function ($data) {
                return  $data['tgl_jatuh_tempo'];
            })
            ->rawColumns(['pembayaran'])
            ->make(true);
    }

    public function barang_dashboard(){
        $data = Barang::orderBy('stok', 'ASC')->limit(10)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kode', function ($data) {
                return $data->kode_barang;
            })
            ->addColumn('nama', function ($data) {
                return $data->nama_barang;
            })
            ->addColumn('merk', function ($data) {
                return ucfirst($data->Merek->nama_merek);
            })
            ->addColumn('tipe', function ($data) {
                return  ucfirst($data->Tipe->nama_tipe);
            })
            ->addColumn('harga_beli', function ($data) {
                return $data->harga_beli;
            })
            ->addColumn('harga_jual', function ($data) {
                return $data->harga_jual;
            })
            ->addColumn('stok', function ($data) {
                return $data->stok;
            })
            ->addColumn('button', function ($data) {
                return ' <div class="grid grid-cols-2 tw-contents">
                                                    <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                                                      data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button>
                                                    <button id="btndelete"       data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
                                                </div>';
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function barang_select(Request $r)
    {
        $d1 = Barang::where('nama_barang', 'LIKE', '%' . $r->input('term', '') . '%')->selectRaw('kode_barang as id_item, nama_barang as nama, IF(id IS NULL, "", "barang") as jenis, stok as stok, harga_jual as harga')->get();
        $d2 = Jasa::where('nama_jasa', 'LIKE', '%' . $r->input('term', '') . '%')->selectRaw('id as id_item, nama_jasa as nama, IF(id IS NULL, "", "jasa") as jenis, harga as harga')->get();
        $data = array();
        $count = 0;
        if (count($d1) > 0) {
            $count = count($d1);
            foreach ($d1 as $key => $d) {
                $data[$key] = array(
                    'id' => $d->id_item,
                    'nama' => $d->nama,
                    'stok' => $d->stok,
                    'jenis' => $d->jenis,
                    'harga' => $d->harga
                );
            }
        }
        if (count($d2) > 0) {
            foreach ($d2 as $key => $d) {
                $data[$count + $key] = array(
                    'id' => $d->id_item,
                    'nama' => $d->nama,
                    'stok' => 100000000,
                    'jenis' => $d->jenis,
                    'harga' => $d->harga
                );
            }
        }
        return response()->json($data);
    }

    public function customer_select(Request $r)
    {
        $data = Customer::where('nama_customer', 'LIKE', '%' . $r->input('term', '') . '%')->select('id', 'nama_customer')->get();
        echo json_encode($data);
    }

    public function garansi_transaksi_jual_select()
    {
        $date = Carbon::now()->toDateString();
        $res = TransJual::where('tgl_max_garansi', '>=', $date)->with('Booking.Customer', 'DTransJual.Barang')->has('DTransJual')->doesntHave('ReturJual')->get();
        $data = array();

        foreach ($res as $i => $p) {
            $data[$i] = array(
                'id' => $p->id,
                'no_trans_jual' => $p->no_trans_jual,
                'tgl_trans_jual' => $p->tgl_trans_jual,
                'tgl_max_garansi' => $p->tgl_max_garansi,
                'customer' => $p->Booking->Customer->nama_customer,
                'alamat' => $p->Booking->Customer->alamat,
                'telepon' => $p->Booking->Customer->telepon,
                'detail' => array()
            );
            foreach ($p->DTransJual as $key => $d) {
                $data[$i]['detail'][$key] = array(
                    'id' => $d->barang_id,
                    'text' => $d->Barang->nama_barang,
                    'jumlah' => $d->jumlah,
                    'harga' => $d->harga,
                    'disc' => $d->disc
                );
            }
        }

        return response()->json($data);
    }

    public function get_d_trans_jual($id)
    {
        $data = array();
        $p = DTransJual::where('htrans_jual_id', $id)->get();
        foreach ($p as $key => $d) {
            $data[$key] = array(
                'id' => $d->barang_id,
                'text' => $d->Barang->nama_barang,
                'jumlah' => $d->jumlah,
                'harga' => $d->harga,
                'disc' => $d->disc
            );
        }
        return response()->json($data);
    }
    public function booking_select(Request $r)
    {
        $data = Booking::doesntHave('TransJual')->with('Customer', 'DBooking.Barang', 'DBooking.Jasa')->where('no_booking', 'LIKE', '%' . $r->input('term', '') . '%')->get();
        echo json_encode($data);
    }

    public function pembayaran_select(Request $r)
    {
        $data = Pembayaran::where('nama_bayar', 'LIKE', '%' . $r->input('term', '') . '%')->get();
        echo json_encode($data);
    }

    public function master_barang()
    {
        $merek = Merek::all();
        return view('layouts.master.barang', ['merek' => $merek]);
    }

    public function master_customer()
    {
        // $kota = Kota::Has('Customer')->get();
        $kota = Kota::all();
        return view('layouts.master.customer', ['kota' => $kota]);
    }
    public function master_supplier()
    {
        // $kota = Kota::Has('Supplier')->get();
        $kota = Kota::all();
        return view('layouts.master.supplier', ['kotas' => $kota]);
    }
    public function customer_create()
    {
        $kota = Kota::all();
        return view('layouts.modal.customer-modal-create', ['kota' => $kota]);
    }
    public function koreksi_create()
    {
        $kota = Kota::all();
        return view('layouts.modal.koreksi-modal-create', ['kota' => $kota]);
    }

    public function substitusi_data()
    {
        $data = Subtitusi::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('tgl_subtitusi', function ($data) {
                return $data->tgl_subtitusi;
            })
            ->editColumn('barang_id_1', function ($data) {
                return $data->Barang1->nama_barang;
            })
            ->editColumn('barang_id_2', function ($data) {
                return $data->Barang2->nama_barang;
            })
            ->addColumn('button', function ($data) {
                return ' <div class="grid grid-cols-2 tw-contents">
                    <button href="" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" id="editButton">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button data-toggle="modal" class="tw-bg-transparent tw-border-none" id="deletebutton">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function substitusi_create()
    {
        $barang = Barang::all();
        return view('layouts.modal.substitusi-modal-create', ['barang' => $barang]);
    }

    public function substitusi_store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'tgl_subtitusi' => ['required'],
            'barang_id_1' => ['required'],
            'barang_id_2' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data telah diisi dengan benar"]);
        } else {
            $c = Subtitusi::create([
                'tgl_subtitusi' => $r->tgl_subtitusi,
                'barang_id_1' => $r->barang_id_1,
                'barang_id_2' => $r->barang_id_2
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function substitusi_edit($id)
    {
        $data = Subtitusi::find($id);
        $barang = Barang::all();
        return view('layouts.modal.substitusi-modal-edit', ['barang' => $barang, 'data' => $data]);
    }

    public function substitusi_update(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'tgl_subtitusi' => ['required'],
            'barang_id_1' => ['required'],
            'barang_id_2' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data telah diisi dengan benar"]);
        } else {
            $u = Subtitusi::find($id);
            $u->tgl_subtitusi = $r->tgl_subtitusi;
            $u->barang_id_1 = $r->barang_id_1;
            $u->barang_id_2 = $r->barang_id_2;
            $u->save();

            if ($u) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function substitusi_delete(Request $request)
    {
        $b = Subtitusi::find($request->id);
        $delete = $b->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function customer_edit($id)
    {
        $kota = Kota::all();
        $data = Customer::find($id);
        return view('layouts.modal.customer-modal-edit', ['kota' => $kota, 'data' => $data]);
    }
    public function promo_create()
    {
        $data = Barang::all();
        $jasa = Jasa::all();
        return view('layouts.modal.promo-modal-create', ['data' => $data, 'jasa' => $jasa]);
    }

    public function promo_edit($id)
    {
        $data = Promo::find($id);
        $barang = Barang::all();
        $jasa = Jasa::all();
        return view('layouts.modal.promo-modal-edit', ['data' => $data, 'barang' => $barang, 'jasa' => $jasa]);
    }
    public function customer_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => ['required', 'unique:customer,nama_customer'],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telepon' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Customer::create([
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
                'kota_id' => $request->kota_id,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }


    public function customer_data($id)
    {
        if ($id != 0) {
            $data = Customer::with(['Kota'])->where('kota_id', $id)->get();
        } else {
            $data = Customer::with(['Kota'])->get();
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                return $data->nama_customer;
            })
            ->addColumn('alamat', function ($data) {
                return $data->alamat;
            })
            ->addColumn('kota', function ($data) {
                return ucfirst($data->Kota->nama_kota);
            })
            ->addColumn('telepon', function ($data) {
                return  $data->telepon;
            })
            ->addColumn('button', function ($data) {
                return ' <div class="grid grid-cols-2 tw-contents">
                                                        <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                                                          data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                                        </button>
                                                        <button id="btndelete"       data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '"
                                                            class="tw-bg-transparent tw-border-none">
                                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                                        </button>
                                                    </div>';
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function customer_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => ['required', 'unique:customer,nama_customer,' . $id],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telepon' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $customer = Customer::find($id);
            $customer->update($data);

            if ($customer) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function customer_delete(Request $request)
    {
        $b = Customer::find($request->id);
        $delete = $b->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }

    public function master_tipe_data()
    {
        $data = Tipe::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                    <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                    data-id="' . $data->id . '"   data-nama="' . $data->nama_tipe . '" >
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button id="btndelete" class="mr-4 tw-bg-transparent tw-border-none"
                    data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_kota_data()
    {
        $data = Kota::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                    <a href="/api/kota/edit/' . $data->kode_kota . '" class="mr-4">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </a>
                    <a href="/api/kota/delete/' . $data->kode_kota . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </a>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }




    public function promo_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_promo' => ['required'],
            'tgl_mulai' => ['required'],
            'tgl_selesai' => ['required'],
            'qty_sk' => ['required'],
            'disc' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Promo::create([
                'kode_promo' => $request->kode_promo,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'nama_promo' => $request->nama_promo,
                'barang_id' => $request->barang_id,
                'jasa_id' => $request->jasa_id,
                'qty_sk' => $request->qty_sk,
                'disc' => $request->disc,
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }
    public function promo_data($tgl_min, $tgl_max)
    {
        $data = NULL;
        if($tgl_min == "0" && $tgl_max == "0"){
            $data = Promo::with('Barang');
        }
        else if($tgl_min != "0" && $tgl_max != "0"){
            $data = Promo::with('Barang')->where('tgl_mulai', '<=', $tgl_min)->where('tgl_selesai', '>=', $tgl_max)->get();
        }
        else if($tgl_min != "0" && $tgl_max == "0"){
            $data = Promo::with('Barang')->where('tgl_mulai', '<=', $tgl_min)->get();
        }
        else if($tgl_min != "0" && $tgl_max == "0"){
            $data = Promo::with('Barang')->where('tgl_selesai', '>=', $tgl_max)->get();
        }
        
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kode_promo', function ($data) {
                return $data->kode_promo;
            })
            ->addColumn('tgl_mulai', function ($data) {
                return $data->tgl_mulai;
            })
            ->addColumn('tgl_selesai', function ($data) {
                return $data->tgl_selesai;
            })
            ->addColumn('nama_promo', function ($data) {
                return $data->nama_promo;
            })
            ->addColumn('barang', function ($data) {
                return $data->barang_id != NULL ? $data->Barang->nama_barang : $data->Jasa->nama_jasa;
            })
            ->addColumn('qty', function ($data) {
                return $data->qty_sk;
            })
            ->addColumn('disc', function ($data) {
                return $data->disc . ' %';
            })
            ->addColumn('button', function ($data) {
                return ' <div class="grid grid-cols-2 tw-contents">
                                                        <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                                                          data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                                        </button>
                                                        <button id="btndelete"       data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '"
                                                            class="tw-bg-transparent tw-border-none">
                                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                                        </button>
                                                    </div>';
            })
            ->rawColumns(['button'])
            ->make(true);
    }

    public function promo_update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'kode_promo' => ['required', 'unique:promo,kode_promo,' . $id],
            'tgl_mulai' => ['required'],
            'tgl_selesai' => ['required'],
            'qty_sk' => ['required'],
            'disc' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            if ($request->jenis == 'barang' && $request->barang_id == '') {
                return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
            }

            if ($request->jenis == 'jasa'  && $request->jasa_id == '') {
                return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
            }


            $promo = Promo::find($id);
            $promo->kode_promo = $request->kode_promo;
            $promo->tgl_mulai = $request->tgl_mulai;
            $promo->tgl_selesai = $request->tgl_selesai;
            $promo->nama_promo = $request->nama_promo;
            $promo->barang_id = $request->jenis == 'barang' ? $request->barang_id : NULL;
            $promo->jasa_id =  $request->jenis == 'jasa'  ? $request->jasa_id : NULL;
            $promo->qty_sk = $request->qty_sk;
            $promo->disc = $request->disc;
            $promo->save();


            if ($promo) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }
    public function promo_delete(Request $request)
    {
        $b = Promo::find($request->id);
        $delete = $b->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }


    //MEREK
    public function master_merek_data()
    {
        $data = Merek::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return   '<div class="grid grid-cols-2 tw-contents">
                        <button class="mr-4 tw-bg-transparent tw-border-none" id="btnedit" data-id="' . $data->id . '"   data-nama="' . $data->nama_merek . '">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button id="btndelete" class="tw-bg-transparent tw-border-none" data-id="' . $data->id . '"   data-nama="' . $data->nama_merek . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_merek_create()
    {
        return view('layouts.modal.merk-modal-create');
    }

    public function master_merek_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_merek' => ['required', 'unique:merek,kode_merek'],
            'nama_merek' => ['required', 'unique:merek,nama_merek'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Merek::create([
                'kode_merek' => $request->kode_merek,
                'nama_merek' => $request->nama_merek,
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_merek_edit($id)
    {
        $data = Merek::find($id);
        return view('layouts.modal.merk-modal-edit', ['data' => $data]);
    }

    public function master_merek_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_merek' => ['required', 'unique:merek,kode_merek,' . $id],
            'nama_merek' => ['required', 'unique:merek,nama_merek,' . $id]
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $merek = Merek::find($id);
            $merek->update($data);

            if ($merek) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_merek_delete(Request $request)
    {
        $merek = Merek::find($request->id);
        $delete = $merek->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }

    //SATUAN
    public function master_satuan_data()
    {
        $data = Satuan::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btnedit" data-id="' . $data->id . '"   data-nama="' . $data->nama_satuan . '">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button id="btndelete" class="tw-bg-transparent tw-border-none" data-id="' . $data->id . '"   data-nama="' . $data->nama_satuan . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_satuan_create()
    {
        return view('layouts.modal.satuan-modal-create');
    }

    public function master_satuan_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_satuan' => ['required', 'unique:satuan,kode_satuan'],
            'nama_satuan' => ['required', 'unique:satuan,nama_satuan'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Satuan::create([
                'kode_satuan' => $request->kode_satuan,
                'nama_satuan' => $request->nama_satuan
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_satuan_edit($id)
    {
        $data = Satuan::find($id);
        return view('layouts.modal.satuan-modal-edit', ['data' => $data]);
    }

    public function master_satuan_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_satuan' => ['required', 'unique:satuan,kode_satuan,' . $id],
            'nama_satuan' => ['required', 'unique:satuan,nama_satuan,' . $id]
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $satuan = Satuan::find($id);
            $satuan->update($data);

            if ($satuan) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_satuan_delete(Request $request)
    {
        $satuan = Satuan::find($request->id);
        $delete = $satuan->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }

    //PEGAWAI
    public function master_pegawai_data()
    {
        $data = Pegawai::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btnedit" data-id="' . $data->id . '"   data-nama="' . $data->nama_pegawai . '">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button id="btndelete" class="tw-bg-transparent tw-border-none" data-id="' . $data->id . '"   data-nama="' . $data->nama_pegawai . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_pegawai_create()
    {
        return view('layouts.modal.pegawai-modal-create');
    }

    public function master_pegawai_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pegawai' => ['required', 'unique:pegawai,kode_pegawai'],
            'nama_pegawai' => ['required', 'unique:pegawai,nama_pegawai'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan pastikan untuk mengisi data dengan benar"]);
        } else {
            $c = Pegawai::create([
                'kode_pegawai' => $request->kode_pegawai,
                'nama_pegawai' => $request->nama_pegawai,
                'gender' => $request->gender,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_pegawai_edit($id)
    {
        $data = Pegawai::find($id);
        return view('layouts.modal.pegawai-modal-edit', ['data' => $data]);
    }

    public function master_pegawai_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pegawai' => ['required', 'unique:pegawai,kode_pegawai,' . $id],
            'nama_pegawai' => ['required', 'unique:pegawai,nama_pegawai,' . $id]
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan pastikan untuk mengisi data dengan benar"]);
        } else {

            $data = $request->all();
            $pegawai = Pegawai::find($id);
            $pegawai->update($data);

            if ($pegawai) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_pegawai_delete(Request $request)
    {
        $pegawai = Pegawai::find($request->id);
        $delete = $pegawai->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }

    //JASA
    public function master_jasa_data()
    {
        $data = Jasa::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                    <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->nama_barang . '" >
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->nama_barang . '"
                        class="tw-bg-transparent tw-border-none">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_jasa_create()
    {
        return view('layouts.modal.jasa-modal-create');
    }

    public function master_jasa_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jasa' => ['required', 'unique:jasa,nama_jasa'],
            'harga' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Jasa::create([
                'nama_jasa' => $request->nama_jasa,
                'harga' => str_replace(",", "", $request->harga)
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_jasa_edit($id)
    {
        $data = Jasa::find($id);
        return view('layouts.modal.jasa-modal-edit', ['data' => $data]);
    }

    public function master_jasa_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jasa' => ['required', 'unique:jasa,nama_jasa,' . $id],
            'harga' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $jasa = Jasa::find($id);
            $jasa->nama_jasa = $request->nama_jasa;
            $jasa->harga = str_replace(",", "", $request->harga);
            $save = $jasa->save();

            if ($save) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_jasa_delete(Request $request)
    {
        $jasa = Jasa::find($request->id);
        $delete = $jasa->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }

    public function master_tipe_create()
    {
        return view('layouts.modal.tipe-modal-create');
    }

    public function master_tipe_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tipe' => ['required', 'unique:tipe,kode_tipe'],
            'nama_tipe' => ['required', 'unique:tipe,nama_tipe'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Tipe::create([
                'kode_tipe' => $request->kode_tipe,
                'nama_tipe' => $request->nama_tipe
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_tipe_edit($id)
    {
        $data = Tipe::find($id);
        return view('layouts.modal.tipe-modal-edit', ['data' => $data]);
    }

    public function master_tipe_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tipe' => ['required', 'unique:tipe,kode_tipe,' . $id],
            'nama_tipe' => ['required', 'unique:tipe,nama_tipe,' . $id]
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $tipe = Tipe::find($id);
            $tipe->update($data);

            if ($tipe) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_tipe_delete(Request $request)
    {
        $tipe = Tipe::find($request->id);
        $delete = $tipe->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }




    //USER
    public function master_user_data()
    {
        $data = User::with('LevelUser', 'Pegawai')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('nama_user', function ($data) {
                return $data->Pegawai->nama_pegawai;
            })
            ->editColumn('level_user_id', function ($data) {
                return $data->LevelUser->nama_level;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2 tw-contents">
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btnedit" data-id="' . $data->id . '"   data-nama="' . $data->username . '">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btndelete" data-id="' . $data->id . '"   data-nama="' . $data->username . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_user_create()
    {
        $pegawai = Pegawai::doesntHave('user')->get();
        $level_user = LevelUser::all();
        return view('layouts.modal.user-modal-create', ['pegawai' => $pegawai, 'level_user' => $level_user]);
    }

    public function master_user_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username_form' => ['required', 'unique:user,username'],
            'email_form' => ['required', 'unique:user,email'],
            'pegawai_id' => ['required'],
            'level_user_id' => ['required'],
            'password_form' => ['required']
        ]);
        if ($validator->fails() || $request->password_form !== $request->conf_pass) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = User::create([
                'username' => $request->username_form,
                'pegawai_id' => $request->pegawai_id,
                'level_user_id' => $request->level_user_id,
                'password' =>  Hash::make($request->password_form),
                'email' => $request->email_form
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => 'Data berhasil di Tambah']);
            } else {
                return response()->json(['data' => 'error', 'msg' => 'Tambah data Gagal, periksa kembali']);
            }
        }
    }

    public function master_user_edit($id)
    {
        $user = User::with('Pegawai')->where('id', $id)->first();
        $level_user = LevelUser::all();
        return view('layouts.modal.user-modal-edit', ['data' => $user, 'level_user' => $level_user]);
    }

    public function master_user_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username_form' => ['required', 'unique:user,username,' . $id],
            'email_form' => ['required', 'unique:user,email,' . $id],
            'level_user_id' => ['required']
        ]);
        if ($validator->fails() || $request->password_form !== $request->conf_pass) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $data = $request->all();
            $user = User::find($id);
            $user->username = $request->username_form;
            $user->level_user_id = $request->level_user_id;
            // if (!Hash::check($request->password, $user->password)) {
            $user->password =  Hash::make($request->password_form);
            // }
            $user->email = $request->email_form;
            $u = $user->save();

            if ($u) {
                return response()->json(['data' => 'success', 'msg' => 'Data berhasil di Ubah']);
            } else {
                return response()->json(['data' => 'error', 'msg' => 'Ubah data Gagal, periksa kembali']);
            }
        }
    }

    public function master_user_delete(Request $request)
    {
        $b = User::find($request->id);
        $delete = $b->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }



    //SUPPLIER
    public function master_supplier_data($id)
    {
        $data = NULL;
        if($id != 0){
            $data = Supplier::with(['Kota'])->where('kota_id', $id)->get();
        }else{
            $data = Supplier::with(['Kota'])->get();
        }
        
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('kota_id', function ($data) {
                return $data->Kota->nama_kota;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2 tw-contents">
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btnedit" data-id="' . $data->id . '"   data-nama="' . $data->nama_supplier . '">
                        <i class="fa fa-pen tw-text-prim-blue"></i>
                    </button>
                    <button class="mr-4 tw-bg-transparent tw-border-none" id="btndelete" data-id="' . $data->id . '"   data-nama="' . $data->nama_supplier . '">
                        <i class="fa fa-trash tw-text-prim-red"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function master_supplier_create()
    {
        $kota = Kota::all();
        return view('layouts.modal.supplier-modal-create', ['kota' => $kota]);
    }

    public function master_supplier_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => ['required', 'unique:supplier,nama_supplier'],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telepon' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Supplier::create([
                'kota_id' => $request->kota_id,
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_supplier_edit($id)
    {
        $data = Supplier::find($id);
        $kota = Kota::all();
        return view('layouts.modal.supplier-modal-edit', ['data' => $data, 'kota' => $kota]);
    }

    public function master_supplier_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => ['required', 'unique:supplier,nama_supplier,' . $id],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telepon' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $supplier = Supplier::find($id);
            $supplier->update($data);

            if ($supplier) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_supplier_delete(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $delete = $supplier->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Berhasil menghapus data']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Gagal menghapus data, periksa kembali data']);
        }
    }

    public function master_user()
    {
        return view('layouts.master.user');
    }
    public function master_promo()
    {
        return view('layouts.master.promo');
    }
    public function master_merk()
    {
        return view('layouts.master.merk');
    }
    public function master_tipe()
    {
        return view('layouts.master.tipe');
    }
    public function master_jasa()
    {
        return view('layouts.master.jasa');
    }
    public function master_pegawai()
    {
        return view('layouts.master.pegawai');
    }

    public function master_satuan()
    {
        return view('layouts.master.satuan');
    }
    public function master_koreksi()
    {
        return view('layouts.master.koreksi');
    }
    public function master_substitusi()
    {
        return view('layouts.master.substitusi');
    }



    public function archive_master()
    {
        return view('layouts.archive.archive_master');
    }




    //Store
    public function koreksi_store(Request $request)
    {
        $bool = true;
        //  dd($request);
        $validator = Validator::make($request->all(), [
            'koreksi_tanggal' => ['required'],
            'koreksi_jenis' => ['required'],
            'koreksi_barang' => ['required'],
            'koreksi_jumlah' => ['required'],

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $barang = Barang::find($request->koreksi_barang);
            if ($request->koreksi_jenis == 'in') {
                $barang->increment('stok', $request->koreksi_jumlah);
            } else {
                if ($request->koreksi_jumlah > $barang->stok) {
                    return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
                } else {
                    $barang->decrement('stok', $request->koreksi_jumlah);
                }
            }

            $c = Koreksi::create([
                'barang_id' => $request->koreksi_barang,
                'tgl_koreksi' => $request->koreksi_tanggal,
                'jumlah' => $request->koreksi_jumlah,
                'jenis' => $request->koreksi_jenis,
                'keterangan' => $request->koreksi_keterangan,
            ]);

            if(!$c){
                $bool = false;
            }

            if ($bool == true) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }
    public function master_barang_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => ['required', 'unique:barang,kode_barang'],
            'nama_barang' => ['required'],
            'tipe' => ['required'],
            'merk' => ['required'],
            'satuan' => ['required'],
            'harga_jual' => ['required'],
            'harga_beli' => ['required'],
            'stok' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {
            $c = Barang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'tipe_id' => $request->tipe,
                'merek_id' => $request->merk,
                'satuan_id' => $request->satuan,
                // 'supplier_id' => $request->supplier,
                'harga_jual' => str_replace(",", "", $request->harga_jual),
                'harga_beli' => str_replace(",", "", $request->harga_beli),
                'stok' => $request->stok
            ]);

            if ($c) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Tambah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Tambah data Gagal, periksa kembali"]);
            }
        }
    }

    public function data_koreksi($id)
    {
        if ($id != 0) {
            $data = Koreksi::with(['Barang'])->where('barang_id', $id)->get();
        } else {
            $data = Koreksi::with(['Barang'])->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('tgl_koreksi', function ($data) {
                    return $data->tgl_koreksi;
                })
                ->addColumn('jenis', function ($data) {
                    return $data->jenis == 'in' ? 'Stok Masuk' : 'Stok Keluar';
                })
                ->addColumn('nama', function ($data) {
                    return $data->Barang->nama_barang;
                })
                ->addColumn('jumlah', function ($data) {
                    return $data->jumlah;
                })
                ->addColumn('ket', function ($data) {
                    return $data->keterangan;
                })

                ->addColumn('button', function ($data) {
                    return ' <div class="grid grid-cols-2 tw-contents">
                                                    <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                                                      data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button>
                                                    <button id="btndelete"       data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
                                                </div>';
                })
                ->rawColumns(['button'])
                ->make(true);
        }
    }
    public function master_barang_data($id)
    {
        if ($id != 0) {
            $data = Barang::with(['Merek', 'Tipe'])->where('merek_id', $id)->get();
        } else {
            $data = Barang::with(['Merek', 'Tipe'])->get();
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kode', function ($data) {
                return $data->kode_barang;
            })
            ->addColumn('nama', function ($data) {
                return $data->nama_barang;
            })
            ->addColumn('merk', function ($data) {
                return ucfirst($data->Merek->nama_merek);
            })
            ->addColumn('tipe', function ($data) {
                return  ucfirst($data->Tipe->nama_tipe);
            })
            ->addColumn('harga_beli', function ($data) {
                return $data->harga_beli;
            })
            ->addColumn('harga_jual', function ($data) {
                return $data->harga_jual;
            })
            ->addColumn('stok', function ($data) {
                return number_format($data->stok);
            })
            ->addColumn('button', function ($data) {
                return ' <div class="grid grid-cols-2 tw-contents">
                                                    <button id="btnedit" class="mr-4 tw-bg-transparent tw-border-none"
                                                      data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '" >
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button>
                                                    <button id="btndelete"       data-id="' . $data->id . '"   data-nama="' . $data->nama_barang . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
                                                </div>';
            })
            ->rawColumns(['button'])
            ->make(true);
    }
    public function master_barang_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => ['required', 'unique:barang,kode_barang,' . $id],
            'nama_barang' => ['required'],
            'tipe' => ['required'],
            'merk' => ['required'],
            'harga_jual' => ['required'],
            'harga_beli' => ['required'],
            'stok' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'error', 'msg' => "Periksa dan Pastikan data yang sudah diisi dengan benar"]);
        } else {

            $data = $request->all();
            $barang = Barang::find($id);
            $barang->kode_barang = $request->kode_barang;
                $barang->nama_barang = $request->nama_barang;
                $barang->tipe_id = $request->tipe;
                $barang->merek_id = $request->merk;
                $barang->satuan_id = $request->satuan;
                // $barang->supplier_id = $request->supplier;
                $barang->harga_jual = str_replace(",", "", $request->harga_jual);
                $barang->harga_beli = str_replace(",", "", $request->harga_beli);
                $barang->stok = $request->stok;
            $bu = $barang->save();

            if ($bu) {
                return response()->json(['data' => 'success', 'msg' => "Data berhasil di Ubah"]);
            } else {
                return response()->json(['data' => 'error', 'msg' => "Ubah data Gagal, periksa kembali"]);
            }
        }
    }

    public function master_barang_create()
    {
        $tipe = Tipe::all();
        $merek = Merek::all();
        $satuan = Satuan::all();
        $supplier = Supplier::all();
        return view('layouts.modal.barang-modal-create', ['tipe' => $tipe, 'merek' => $merek, 'satuan' => $satuan, 'supplier' => $supplier]);
    }

    public function master_barang_delete(Request $request)
    {
        $b = Barang::find($request->id);
        $delete = $b->delete();
        if ($delete) {
            return response()->json(['info' => 'success', 'msg' => 'Data berhasil di hapus']);
        } else {
            return response()->json(['info' => 'error', 'msg' => 'Hapus Gagal, periksa kembali']);
        }
    }
    public function master_barang_edit($id)
    {
        $data = Barang::find($id);
        $tipe = Tipe::all();
        $merek = Merek::all();
        $supplier = Supplier::all();
        $satuan = Satuan::all();
        return view('layouts.modal.barang-modal-edit', ['tipe' => $tipe, 'merek' => $merek, 'supplier' => $supplier, 'satuan' => $satuan, 'data' => $data]);
    }
    public function master_barang_select_data(Request $request)
    {
        $data = Barang::where('nama_barang', 'LIKE', '%' . $request->input('term', '') . '%')
            ->orderby('nama_barang', 'ASC')->get();
        echo json_encode($data);
    }

    public function master_barang_select_data_detail($id)
    {
        $data = Barang::find($id);
        echo json_encode($data);
    }
    public function master_barang_select_data_po(Request $request, $id)
    {

        // $data = Barang::whereHas('DTransBeli', function ($q) use ($id) {
        //     $q->where('htrans_beli_id', $id);
        // })->where('nama_barang', 'LIKE', '%' . $request->input('term', '') . '%')->get();
        $array = array();
        $data = DTransBeli::where('htrans_beli_id', $id)->with('Barang')->get();
        foreach($data as $key => $i){
            $array[$key] = array('id' => $i->Barang->id, 
            'nama_barang' => $i->Barang->nama_barang, 
            'jumlah' => $i->jumlah);
        }
        echo json_encode($array);
    }
}
