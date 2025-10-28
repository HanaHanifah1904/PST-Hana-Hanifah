@extends('layout.v_template2')

@section('title', 'Tentang Kami')
@section('sidebar-title', 'Tentang Kami')

@section('content')
<style>
.truncate {
    display: -webkit-box;
    -webkit-line-clamp: 3; /* tampilkan 3 baris pertama */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 4.5rem;
}

.btn-link {
    color: #0d6efd;
    font-weight: 500;
    font-size: 0.9rem;
}
.btn-link:hover {
    text-decoration: underline;
}
</style>

<div class="container">
    <h3 class="mb-4"><i class="fas fa-edit me-2"></i> Tentang Kami</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- === FORM INPUT BARU === --}}
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

    {{-- === DAFTAR TENTANG KAMI === --}}
    <h4 class="mb-3">Daftar Tentang Kami</h4>
    <div class="row">
        @forelse($tentangKami as $item)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $item->judul }}</h5>

                                {{-- Deskripsi dengan "Lihat Selengkapnya" --}}
                                <p id="shortDesc{{ $item->id }}" class="card-text text-muted truncate">
                                    {{ $item->deskripsi }}
                                </p>
                                <div class="collapse" id="fullDesc{{ $item->id }}">
                                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                                </div>

                                {{-- Tombol toggle deskripsi --}}
                                @if(strlen($item->deskripsi) > 150)
                                    <button class="btn btn-link p-0 text-decoration-none"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#fullDesc{{ $item->id }}"
                                        aria-expanded="false"
                                        aria-controls="fullDesc{{ $item->id }}">
                                        <i class="fas fa-eye"></i> Lihat Selengkapnya
                                    </button>
                                @endif

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

                        {{-- FOTO --}}
                        <div class="col-md-6 text-center p-3">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Tentang Kami" 
                                     class="img-fluid rounded" 
                                     style="max-height: 250px; object-fit: cover;">
                            @else
                                <p class="text-muted fst-italic mt-5">Tidak ada foto</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
