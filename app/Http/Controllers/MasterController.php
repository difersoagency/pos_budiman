<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
                <a href="/api/barang/edit/'.$data->id.'" class="mr-4">
                    <i class="fa fa-pen tw-text-prim-blue"></i>
                </a>
                <a href="/api/barang/delete/'.$data->id.'">
                    <i class="fa fa-trash tw-text-prim-red"></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
