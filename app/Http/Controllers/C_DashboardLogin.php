<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_DashboardLogin extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
