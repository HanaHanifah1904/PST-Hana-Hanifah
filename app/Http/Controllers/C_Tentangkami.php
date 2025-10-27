<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_TentangKami;

class C_TentangKami extends Controller
{
    // Tampilkan halaman admin
    public function index()
    {
        $tentangKami = M_TentangKami::latest()->get();
        return view('v_tentangkami', compact('tentangKami'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/tentangkami', $filename, 'public');
            $data['foto'] = 'storage/uploads/tentangkami/' . $filename;
        }

        M_TentangKami::create($data);

        return redirect()->back()->with('success', 'Data Tentang Kami berhasil disimpan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $item = M_TentangKami::findOrFail($id);
        return view('v_tentangkamiedit', compact('item'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096'
        ]);

        $item = M_TentangKami::findOrFail($id);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/tentangkami', $filename, 'public');
            $data['foto'] = 'uploads/tentangkami/' . $filename; // ✅ BENAR

            // Hapus foto lama
            if ($item->foto && file_exists(public_path($item->foto))) {
                unlink(public_path($item->foto));
            }
        }

        $item->update($data);

        return redirect()->route('tentangkami.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $item = M_TentangKami::findOrFail($id);

        if ($item->foto && file_exists(public_path($item->foto))) {
            unlink(public_path($item->foto));
        }

        $item->delete();

        return redirect()->route('tentangkami.index')->with('success', 'Data berhasil dihapus!');
    }
}
