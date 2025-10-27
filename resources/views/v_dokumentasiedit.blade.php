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
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $dokumentasi->judul) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis" class="form-select" required>
                <option value="foto" {{ $dokumentasi->jenis == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="pdf" {{ $dokumentasi->jenis == 'pdf' ? 'selected' : '' }}>PDF</option>
            </select>
        </div>

        <div class="mb-3">
            <label>File Dokumentasi (opsional)</label>
            <input type="file" name="file_path" class="form-control">
            <small class="text-muted">File saat ini: {{ $dokumentasi->file_path }}</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
