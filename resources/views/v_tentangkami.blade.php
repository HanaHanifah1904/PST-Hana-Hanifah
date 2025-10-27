@extends('layout.v_template2')

@section('title', 'Tentang Kami')
@section('sidebar-title', 'Tentang Kami')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-edit me-2"></i> Tentang Kami</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Input Baru --}}
    <form action="{{ route('tentangkami.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Masukkan deskripsi" required></textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept=".jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button>
    </form>

    {{-- Daftar Tentang Kami --}}
    <h4 class="mb-3">Daftar Tentang Kami</h4>
    <div class="row">
        @forelse($tentangKami as $item)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                                <p class="card-text">{{ $item->deskripsi }}</p>

                                {{-- Tombol Edit & Hapus --}}
                                <div class="d-flex justify-content-start mt-3">
                                    <a href="{{ route('tentangkami.edit', $item->id) }}" class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('tentangkami.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid" alt="Foto Tentang Kami">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada data Tentang Kami.</p>
        @endforelse
    </div>
</div>
@endsection
