<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\TransBeli;
use App\Models\DTransJualJasa;
use App\Models\DTransJual;
use App\Models\DPiutang;
use App\Models\TransJual;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
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
    public function data_piutang()
    {
        $data = Piutang::with('TransJual')->addSelect(['sum_total ' => function($q){
            $q->selectRaw('coalesce(SUM(total_bayar), 0)')
            ->from('d_piutang')
            ->whereColumn('d_piutang.h_piutang_id', 'h_piutang.id');
        }])->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no_trans_jual', function($data){
                return $data->TransJual->no_trans_jual;
            })
            ->addColumn('sum_total', function($data){
                return $data->sum_total;
            })
            ->addColumn('sisa_hutang', function($data){
                return $data->total_piutang - $data->sum_total;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-3">
                <button id="btndetail" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->id . '" >
                                                        <i class="fas fa-eye tw-text-prim-blue"></i>
                                                    </button>
                <button id="btnbayar" class="mr-4 tw-bg-transparent tw-border-none" data-id="' . $data->id . '" data-nama="' . $data->id . '" >
                                                        <i class="fas fa-money-check-alt tw-text-prim-blue"></i>
                                                    </button>
                                                    <button id="btndelete" data-id="' . $data->id . '" data-nama="' . $data->id . '"
                                                        class="tw-bg-transparent tw-border-none">
                                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                                    </button>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail_piutang($id)
    {
        $data = Piutang::where('id', $id)->with('TransJual.Booking.Customer')->first();
        return view('layouts.modal.piutang-modal-detail', ['id' => $id, 'data' => $data]);
    }

    public function data_detail_piutang($id){
        $data = DPiutang::where('h_piutang_id', $id)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function tambah_detail_piutang($id){

        return view('layouts.modal.piutang-modal-create', ['id' => $id]);
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

            if($d){
                return redirect()->back()->with('success', "Data berhasil disimpan");
            }
            else{
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
        $satuan = Satuan::all();
        return view('layouts.transaksi.tambah_beli', ['supplier' => $supplier, 'barang' => $barang, 'satuan' => $satuan]);
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

    public function transaksi_jual()
    {
        return view('layouts.transaksi.master-jual');
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


    public function tambah_jual()
    {
        return view('layouts.transaksi.tambah_jual');
    }

    public function store_jual(Request $r){
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
                'total_jual' => $r->total_jual,
                'bayar_jual' => $r->bayar_jual,
                'kembali_jual' => $r->kembali_jual,
                'promo_id' => $r->promo_id,
                'pembayaran_id' => $r->pembayaran_id,
            ]);
            $bool = true;
            $dc = NULL;
            $jb = '';
            if ($c) {
                for($i = 0; $i < count($r->barang_id); $i++){
                    if($r->jenis_brg[$i] == "jasa"){
                        $dc = DTransJualJasa::create([
                            'htrans_jual_id' => $c->id,
                            'jasa_id' => $r->barang_id[$i],
                            'harga' => $r->harga[$i],
                            'disc' => $r->disc[$i]
                        ]);
                    }else if($r->jenis_brg[$i] == "barang"){
                        $dc = DTransJual::create([
                            'htrans_jual_id' => $c->id,
                            'jasa_id' => $r->barang_id[$i],
                            'harga' => $r->harga[$i],
                            'jumlah' => $r->jumlah[$i],
                            'disc' => $r->disc[$i]
                        ]);
                    }
                    if(!$dc){
                        $bool = false;
                    }
                    
                }

                if($r->bayar_jual < $r->total_jual){
                    Piutang::create([
                        'htrans_jual_id' => $c->id,
                        'pembayaran_id' => $r->pembayaran_id,
                        'tgl_piutang' => $r->tgl_trans_jual,
                        'total_piutang' => ($r->total_jual - $r->bayar_jual)
                    ]);
                }
            }
            if($bool == true){
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali".$r->jenis_brg[0]);
            }
        }
    }

    

    


    public function transaksi_retur_beli()
    {
        return view('layouts.transaksi.retur-beli');
    }

    public function data_transaksi_retur_beli(){
        
    }

    public function master_booking()
    {
        return view('layouts.transaksi.master_booking');
    }

    public function data_master_booking(){
        $data = Booking::with('Customer', 'TransJual')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('customer_nama', function($data){
                return $data->Customer->nama_customer;
            })
            ->addColumn('status', function($data){
                if($data->TransJual != NULL){
                    return '<span class="badge badge-success">Selesai</span>';
                }else{
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
                for($i = 0; $i < count($request->barang_id); $i++){
                    if($request->jenis_brg[$i] == "jasa"){
                        $dc = DBooking::create([
                            'booking_id' => $c->id,
                            'barang_id' => NULL,
                            'jasa_id' => $request->barang_id[$i],
                            'jumlah' => $request->jumlah[$i]
                        ]);
                    }else if($request->jenis_brg == "barang"){
                        $dc = DBooking::create([
                            'booking_id' => $c->id,
                            'jasa_id' => NULL,
                            'barang_id' => $request->barang_id[$i],
                            'jumlah' => $request->jumlah[$i]
                        ]);
                    }
                    if(!$dc){
                        $bool = false;
                    }
                    
                }
            }
            if($bool == true){
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali");
            }
        }
    }
}
