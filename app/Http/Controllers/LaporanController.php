<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function archive_laporan()
    {
        return view('layouts.archive.archive-laporan');
    }
}
