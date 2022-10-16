<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Pembayaran;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MasterController extends Controller
{
    public function barang_select(Request $r){
        $d1 = Barang::where('nama_barang', 'LIKE', '%' . $r->input('term', '') . '%')->selectRaw('id as id, nama_barang as nama, IF(id IS NULL, "", "barang") as jenis, harga_jual as harga')->get();
        $d2 = Jasa::where('nama_jasa', 'LIKE', '%' . $r->input('term', '') . '%')->selectRaw('id as id, nama_jasa as nama, IF(id IS NULL, "", "jasa") as jenis, harga as harga')->get();
        $data = $d1->merge($d2);
        echo json_encode($data);
    }

    public function customer_select(Request $r){
        $data = Customer::where('nama_customer', 'LIKE', '%' . $r->input('term', '') . '%')->select('id', 'nama_customer')->get();
        echo json_encode($data);
    }

    public function booking_select(Request $r){
        $data = Booking::with('Customer', 'DBooking.Barang', 'DBooking.Jasa')->where('no_booking', 'LIKE', '%' . $r->input('term', '') . '%')->get();
        echo json_encode($data);
    }

    public function pembayaran_select(Request $r){
        $data = Pembayaran::where('nama_bayar', 'LIKE', '%' . $r->input('term', '') . '%')->get();
        echo json_encode($data);
    }
    

    public function data_customer(){
        $data = Customer::with('Kota')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('kota_id', function($data){
                return $data->Kota->nama_kota;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2 tw-contents">
                <button href="" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" data-target="#customerModal">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </button>
                <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </button>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    
}
