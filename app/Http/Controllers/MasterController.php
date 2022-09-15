<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kota;
use App\Models\Merek;
use App\Models\Satuan;
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
                return  '<div class="grid grid-cols-2">
                <a href="/api/kota/edit/'.$data->kode_merek.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/kota/delete/'.$data->kode_merek.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
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
}
