<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Dokumentasi;

class C_Dokumentasi extends Controller
{
    public function index()
    {
        $dokumentasi = M_Dokumentasi::all();
        return view('v_dokumentasi', compact('dokumentasi'));
    }

    public function store(Request $request)
        {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'jenis' => 'required',
                'file_path' => 'nullable|mimes:pdf,jpg,jpeg,png|max:20480',
                'video_link' => 'nullable|string',
            ]);

            $filePath = null;
            $videoLink = null;
            $jenis = $request->jenis;

            // Jika upload file (foto/pdf)
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $uploadPath = public_path('uploads/dokumentasi');
                if (!file_exists($uploadPath)) mkdir($uploadPath, 0777, true);

                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move($uploadPath, $fileName);
                $filePath = 'uploads/dokumentasi/'.$fileName;
            }

            // Jika upload video (link YouTube)
            if ($jenis === 'video' && $request->video_link) {
                $videoLink = $request->video_link;

                // otomatis ubah dari "watch?v=" jadi "embed/"
                $videoLink = str_replace('watch?v=', 'embed/', $videoLink);
            }

            M_Dokumentasi::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'jenis' => $jenis,
                'file_path' => $filePath,
                'video_link' => $videoLink,
            ]);

            return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diupload!');
        }


    public function edit($id)
    {
        $dokumentasi = M_Dokumentasi::findOrFail($id);
        return view('v_dokumentasiedit', compact('dokumentasi'));
    }

    public function update(Request $request, $id)
    {
        $dokumentasi = M_Dokumentasi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis' => 'required|in:foto,pdf,video',
        ]);

        // Kalau jenis video → update link
        if ($request->jenis === 'video') {
            $request->validate(['video_link' => 'required|string|max:255']);
            $dokumentasi->video_link = $request->video_link;
            $dokumentasi->file_path = null; // kosongkan file jika video
        } else {
            // Jika upload file baru
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/dokumentasi'), $fileName);
                $dokumentasi->file_path = 'uploads/dokumentasi/' . $fileName;
                $dokumentasi->video_link = null;
            }
        }

        // Update field umum
        $dokumentasi->judul = $request->judul;
        $dokumentasi->deskripsi = $request->deskripsi;
        $dokumentasi->jenis = $request->jenis;
        $dokumentasi->save();

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = M_Dokumentasi::findOrFail($id);

        // Hapus file jika ada dan bukan video
        if ($item->file_path && file_exists(public_path($item->file_path))) {
            unlink(public_path($item->file_path));
        }

        $item->delete();
        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus!');
    }
}
