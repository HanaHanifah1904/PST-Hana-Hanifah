<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Dokumentasi;
use App\Models\M_Portofolio;
use App\Models\M_TentangKami;

class C_Halaman extends Controller
{
    public function index()
    {
        $dokumentasi = M_Dokumentasi::latest()->get();
        $portofolio  = M_Portofolio::latest()->get();
        $tentangKami = M_TentangKami::latest()->first() ?? null;

        // kirim semua variabel ke view
        return view('v_halaman', compact('dokumentasi', 'portofolio', 'tentangKami'));
    }
}
