@extends('layout.v_template2')

@section('title', 'Edit Tentang Kami')
@section('sidebar-title', 'Edit Tentang Kami')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-edit me-2"></i> Edit Tentang Kami</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tentangkami.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $item->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ $item->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            @if($item->foto)
                <img src="{{ asset($item->foto) }}" class="img-fluid mb-2" style="height:200px;">
            @endif
            <input type="file" name="foto" id="foto" class="form-control" accept=".jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update</button>
        <a href="{{ route('tentangkami.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
