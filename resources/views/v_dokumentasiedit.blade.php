@extends('layout.v_template2')

@section('content')
<style>
  input.form-control,
  textarea.form-control,
  select.form-select {
    font-weight: bold;
  }
</style>

<div class="container">
    <h4>Edit Dokumentasi</h4>

    <form action="{{ route('dokumentasi.update', $dokumentasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" 
                   value="{{ old('judul', $dokumentasi->judul) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis" id="jenis" class="form-select" required onchange="toggleInput()">
                <option value="foto" {{ $dokumentasi->jenis == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="pdf" {{ $dokumentasi->jenis == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="video" {{ $dokumentasi->jenis == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        {{-- Input file untuk foto/pdf --}}
        <div class="mb-3" id="fileInputDiv" style="display: none;">
            <label>File Dokumentasi (opsional)</label>
            <input type="file" name="file_path" class="form-control" 
                   accept="image/*,application/pdf">
            <small class="text-muted">File saat ini: {{ $dokumentasi->file_path }}</small>
        </div>

        {{-- Input link untuk video --}}
        <div class="mb-3" id="linkInputDiv" style="display: none;">
            <label>Link Video</label>
            <input type="url" name="video_link" class="form-control"
                   placeholder="Masukkan link video (misal YouTube)"
                   value="{{ old('video_link', $dokumentasi->video_link) }}">
            <small class="text-muted">Contoh: https://www.youtube.com/watch?v=abc123</small>
        </div>

        {{-- Preview jika ada --}}
        @if ($dokumentasi->jenis == 'foto')
            <div class="mt-3">
                <img src="{{ asset('storage/' . $dokumentasi->file_path) }}" alt="Preview" class="img-fluid rounded" style="max-width: 300px;">
            </div>
        @elseif ($dokumentasi->jenis == 'pdf')
            <div class="mt-3">
                <embed src="{{ asset('storage/' . $dokumentasi->file_path) }}" type="application/pdf" width="100%" height="400px">
            </div>
        @elseif ($dokumentasi->jenis == 'video' && $dokumentasi->video_link)
            <div class="mt-3">
                <iframe width="420" height="315" src="{{ $dokumentasi->video_link }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    function toggleInput() {
        const jenis = document.getElementById('jenis').value;
        const fileInputDiv = document.getElementById('fileInputDiv');
        const linkInputDiv = document.getElementById('linkInputDiv');

        if (jenis === 'video') {
            linkInputDiv.style.display = 'block';
            fileInputDiv.style.display = 'none';
        } else {
            linkInputDiv.style.display = 'none';
            fileInputDiv.style.display = 'block';
        }
    }

    // Jalankan saat halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', toggleInput);
</script>
@endsection
