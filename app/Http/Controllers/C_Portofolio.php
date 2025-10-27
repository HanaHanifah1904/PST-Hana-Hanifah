<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Portofolio;
use App\Models\M_TentangKami;
use App\Models\M_Dokumentasi;

class C_Portofolio extends Controller
{
    public function index()
    {
        $portofolio = M_Portofolio::latest()->get();
        return view('v_portofolio', compact('portofolio'));
    }

    public function store(Request $request)
    {
        // Validasi input sesuai nama kolom di form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto_path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file ke folder public/uploads/portofolio
        if ($request->hasFile('foto_path')) {
            $file = $request->file('foto_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/portofolio'), $filename);
            $foto_path = 'uploads/portofolio/' . $filename;
        } else {
            $foto_path = null;
        }

        // Simpan data ke database
        M_Portofolio::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto_path' => $foto_path,
        ]);

        return redirect()->back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $portofolio = M_Portofolio::findOrFail($id);

        // Hapus file foto dari storage
        if ($portofolio->foto_path && file_exists(public_path($portofolio->foto_path))) {
            unlink(public_path($portofolio->foto_path));
        }

        // Hapus data di database
        $portofolio->delete();

        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }

    public function edit($id)
{
    $portofolio = M_Portofolio::findOrFail($id);
    return view('v_portofolioedit', compact('portofolio'));
}

public function update(Request $request, $id)
{
    $portofolio = M_Portofolio::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'foto_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $portofolio->judul = $request->judul;
    $portofolio->deskripsi = $request->deskripsi;

    if ($request->hasFile('foto_path')) {
        // hapus foto lama
        if ($portofolio->foto_path && file_exists(public_path($portofolio->foto_path))) {
            unlink(public_path($portofolio->foto_path));
        }
        $file = $request->file('foto_path');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/portofolio'), $filename);
        $portofolio->foto_path = 'uploads/portofolio/'.$filename;
    }

    $portofolio->save();

    return redirect()->route('portofolio.index')->with('success', 'Portofolio berhasil diperbarui!');
}

public function detail($id)
{
    $portofolio = M_Portofolio::findOrFail($id);
    $tentangKami = M_TentangKami::latest()->first(); // hanya satu data, bukan koleksi
    $dokumentasi = M_Dokumentasi::latest()->get();

    return view('v_portofoliodetail', compact('portofolio', 'tentangKami', 'dokumentasi'));
}



}
