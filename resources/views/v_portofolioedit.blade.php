@extends('layout.v_template2')

@section('title', 'Edit Portofolio')
@section('sidebar-title', 'Portofolio')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-edit me-2"></i> Edit Portofolio</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label"><strong>Judul Portofolio</strong></label>
            <input type="text" name="judul" id="judul" class="form-control fw-bold" value="{{ $portofolio->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ $portofolio->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Saat Ini</label><br>
            <img src="{{ asset($portofolio->foto_path) }}" alt="Foto Portofolio" class="img-thumbnail" style="height:150px;">
        </div>

        <div class="mb-3">
            <label for="foto_path" class="form-label">Ganti Foto (Opsional)</label>
            <input type="file" name="foto_path" id="foto_path" class="form-control" accept=".jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
        <a href="{{ route('portofolio.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </form>
</div>
@endsection
