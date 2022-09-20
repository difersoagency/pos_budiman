<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merek;
use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function xxx()
    {
        return view('xxx');
    }

    public function home_owner()
    {
        return view('home_owner');
    }
    public function home_admin()
    {
        return view('home_admin');
    }
    public function home_kasir()
    {
        return view('home_kasir');
    }

    public function master_barang()
    {
        $merek = Merek::all();
        return view('layouts.master.barang', ['merek' => $merek]);
    }

    public function master_customer()
    {
        return view('layouts.master.customer');
    }
    public function master_supplier()
    {
        return view('layouts.master.supplier');
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

    //Store
    public function master_barang_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => ['required', 'unique:barang,kode_barang'],
            'nama_barang' => ['required'],
            'tipe' => ['required'],
            'merek' => ['required'],
            'harga_jual' => ['required'],
            'harga_beli' => ['required'],
            'stok' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Barang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'tipe_id' => $request->tipe,
                'merek_id' => $request->merek,
                'harga_jual' => $request->harga_jual,
                'harga_beli' => $request->harga_beli,
                'stok' => $request->stok,
                'satuan_id' => 1,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
            }
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
            'tipe_id' => ['required'],
            'merek_id' => ['required'],
            'harga_jual' => ['required'],
            'harga_beli' => ['required'],
            'stok' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Data");
        } else {

            $data = $request->all();
            $barang = Barang::find($id);
            $barang->update($data);

            if ($barang) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
            }
        }
    }

    public function master_barang_create()
    {
        $tipe = Tipe::all();
        $merek = Merek::all();
        return view('layouts.modal.barang-modal-create', ['tipe' => $tipe, 'merek' => $merek]);
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
        return view('layouts.modal.barang-modal-edit', ['tipe' => $tipe, 'merek' => $merek, 'data' => $data]);
    }
}
