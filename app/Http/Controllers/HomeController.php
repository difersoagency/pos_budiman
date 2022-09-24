<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Kota;
use App\Models\Merek;
use App\Models\Promo;
use App\Models\Tipe;
use App\Models\Satuan;
use App\Models\Jasa;
use App\Models\Supplier;
use App\Models\Pegawai;
use App\Models\User;
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
        $kota = Kota::all();
        return view('layouts.master.customer', ['kota' => $kota]);
    }
    public function master_supplier()
    {
        $kota = Kota::all();
        return view('layouts.master.supplier', ['kotas' => $kota]);
    }

    //USER
    public function master_user_data(){
        $data = User::with('LevelUser', 'Pegawai')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('nama_user', function($data){
                return $data->Pegawai->nama_pegawai;
            })
            ->editColumn('level_user_id', function($data){
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

    //SUPPLIER
    public function master_supplier_data(){
        $data = Supplier::with('Kota')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('kota_id', function($data){
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Supplier::create([
                'kota_id' => $request->kota_id,
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal Menambahkan, periksa kembali");
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
            'nama_supplier' => ['required', 'unique:supplier,nama_supplier,' . $id]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {

            $data = $request->all();
            $supplier = Supplier::find($id);
            $supplier->update($data);

            if ($supplier) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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

    public function archive_master()
    {
        return view('layouts.archive.archive_master');
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
    public function customer_create()
    {
        $kota = Kota::all();
        return view('layouts.modal.customer-modal-create', ['kota' => $kota]);
    }
    public function customer_edit($id)
    {
        $kota = Kota::all();
        $data = Customer::find($id);
        return view('layouts.modal.customer-modal-edit', ['kota' => $kota, 'data' => $data]);
    }
    public function customer_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => ['required', 'unique:customer,nama_customer'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Customer::create([
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
                'kota_id' => $request->kota_id,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {

            $data = $request->all();
            $customer = Customer::find($id);
            $customer->update($data);

            if ($customer) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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



    public function master_tipe_data(){
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

    public function master_kota_data(){
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

    


    public function promo_create()
    {
        $data = Barang::all();
        return view('layouts.modal.promo-modal-create', ['data' => $data]);
    }

    public function promo_edit($id)
    {
        $data = Promo::find($id);
        $barang = Barang::all();
        return view('layouts.modal.promo-modal-edit', ['data' => $data, 'barang' => $barang]);
    }

    public function promo_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_promo' => ['required'],
            'tgl_mulai' => ['required'],
            'tgl_selesai' => ['required'],
            'barang_id' => ['required'],
            'qty_sk' => ['required'],
            'disc' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Promo::create([
                'kode_promo' => $request->kode_promo,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'nama_promo' => $request->nama_promo,
                'barang_id' => $request->barang_id,
                'qty_sk' => $request->qty_sk,
                'disc' => $request->disc,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
            }
        }
    }
    public function promo_data()
    {
        $data = Promo::with('Barang');
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
                return $data->Barang->nama_barang;
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
            'barang_id' => ['required'],
            'qty_sk' => ['required'],
            'disc' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {

            $data = $request->all();
            $promo = Promo::find($id);
            $promo->update($data);

            if ($promo) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
    public function master_merek_data(){
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Merek::create([
                'kode_merek' => $request->kode_merek,
                'nama_merek' => $request->nama_merek,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {

            $data = $request->all();
            $merek = Merek::find($id);
            $merek->update($data);

            if ($merek) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
    public function master_satuan_data(){
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Satuan::create([
                'kode_satuan' => $request->kode_satuan,
                'nama_satuan' => $request->nama_satuan
                ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan, silahkan periksa data kembali");
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            
            $data = $request->all();
            $satuan = Satuan::find($id);
            $satuan->update($data);
            
            if ($satuan) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
    public function master_pegawai_data(){
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Pegawai::create([
                'kode_pegawai' => $request->kode_pegawai,
                'nama_pegawai' => $request->nama_pegawai,
                'gender' => $request->gender,
                'telepon' => $request->telepon,
            ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {

            $data = $request->all();
            $pegawai = Pegawai::find($id);
            $pegawai->update($data);

            if ($pegawai) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
    public function master_jasa_data(){
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Jasa::create([
                'nama_jasa' => $request->nama_jasa,
                'harga' => $request->harga
                ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan, silahkan periksa data kembali");
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
            'nama_jasa' => ['required', 'unique:jasa,nama_jasa,' . $id]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            
            $data = $request->all();
            $jasa = Jasa::find($id);
            $jasa->update($data);
            
            if ($jasa) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            $c = Tipe::create([
                'kode_tipe' => $request->kode_tipe,
                'nama_tipe' => $request->nama_tipe
                ]);

            if ($c) {
                return redirect()->back()->with('success', "Data berhasil di tambah");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan, silahkan periksa data kembali");
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
            return redirect()->back()->with('error', "Update Gagal, periksa kembali");
        } else {
            
            $data = $request->all();
            $tipe = Tipe::find($id);
            $tipe->update($data);
            
            if ($tipe) {
                return redirect()->back()->with('success', "Data berhasil di update");
            } else {
                return redirect()->back()->with('error', "Update Gagal, periksa kembali");
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
}
