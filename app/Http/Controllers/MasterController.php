<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kota;
use App\Models\Merek;
use App\Models\Satuan;
use App\Models\Tipe;
use App\Models\Jasa;
use App\Models\Customer;
use App\Models\Promo;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MasterController extends Controller
{
    public function data_barang(){
        $data = Barang::with('Tipe', 'Merek', 'Satuan')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('kode_tipe', function ($data) {
                return $data->Tipe->nama;
            })
            ->editColumn('kode_merek', function ($data) {
                return $data->Merek->nama;
            })
            ->editColumn('kode_satuan', function ($data) {
                return $data->Satuan->nama;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <a href="/api/barang/edit/'.$data->kode_barang.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/barang/delete/'.$data->kode_barang.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function data_kota(){
        $data = Kota::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <a href="/api/kota/edit/'.$data->kode_kota.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/kota/delete/'.$data->kode_kota.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function data_merek(){
        $data = Merek::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
            return   '<div class="grid grid-cols-2 tw-contents">
            <button class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" data-target="#merkModal">
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

    public function data_satuan(){
        $data = Satuan::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <a href="/api/kota/edit/'.$data->kode_satuan.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/kota/delete/'.$data->kode_satuan.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

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

    public function data_supplier(){
        $data = Supplier::with('Kota')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('kota_id', function($data){
                return $data->Kota->nama_kota;
            })
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2 tw-contents">
                <a href="" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function data_tipe(){
        $data = Tipe::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <a href="/api/kota/edit/'.$data->id.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/kota/delete/'.$data->id.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function data_jasa(){
        $data = Jasa::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return  '<div class="grid grid-cols-2">
                <a href="/api/kota/edit/'.$data->id.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/kota/delete/'.$data->id.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
