<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('layouts.master.barang');
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
}
