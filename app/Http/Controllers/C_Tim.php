<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Tim;

class C_Tim extends Controller
{
    public function index()
    {
        $tim = M_Tim::all();
        return view('v_tim', compact('tim'));
    }

    public function add()
    {
        return view('v_timadd');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'Kelompok_Petugas' => 'required|string|max:100',
        ], [
            'Kelompok_Petugas.required' => 'Kelompok Petugas wajib dipilih.',
        ]);

        M_Tim::create([
            'Kelompok_Petugas' => $request->Kelompok_Petugas,
        ]);

        return redirect()->route('tim.index')->with('success', 'Tim berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tim = M_Tim::findOrFail($id);
        return view('v_timedit', compact('tim'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Kelompok_Petugas' => 'required|string|max:100',
        ]);

        M_Tim::where('id_tim', $id)->update([
            'Kelompok_Petugas' => $request->Kelompok_Petugas,
        ]);

        return redirect()->route('tim.index')->with('success', 'Tim berhasil diupdate');
    }

    public function destroy($id)
    {
        M_Tim::where('id_tim', $id)->delete();
        return redirect()->route('tim.index')->with('success', 'Tim berhasil dihapus');
    }

    public function detail($id_tim)
    {
        $tim = M_Tim::findOrFail($id_tim); 
        return view('v_timdetail', compact('tim'));
    }
}
