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
}
