@extends('layout.v_template2')

@section('title', 'Portofolio')
@section('sidebar-title', 'Portofolio')

@section('content')
<style>
/* Placeholder tebal */
.placeholder-bold::placeholder {
    font-weight: bold;
    color: #6c757d;
}

/* Biar deskripsi kelihatan rapi saat disembunyikan */
.truncate {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* tampil 2 baris dulu */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<div class="container">
    <h3 class="mb-4"><i class="fas fa-briefcase me-2"></i> Layanan Kami</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah portofolio --}}
    <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" name="judul" class="form-control fw-bold placeholder-bold" placeholder="Judul Portofolio" required>
            </div>
            <div class="col-md-6 mb-3">
                <textarea name="deskripsi" class="form-control fw-bold placeholder-bold" rows="2" placeholder="Deskripsi" required></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <input type="file" name="foto_path" class="form-control" accept=".jpg,.jpeg,.png" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-upload me-2"></i>Upload</button>
    </form>

    <h4 class="mb-3"><i class="fas fa-images me-2"></i>Daftar Portofolio</h4>
    <div class="row">
        @foreach($portofolio as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($item->foto_path) }}" class="card-img-top" style="height:220px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->judul }}</h5>

                        {{-- Deskripsi pendek + tombol lihat selengkapnya --}}
                        <p class="card-text truncate" id="desc-{{ $item->id }}">
                            {{ $item->deskripsi }}
                        </p>
                        <button class="btn btn-link p-0 text-decoration-none" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseDesc{{ $item->id }}"
                            aria-expanded="false"
                            aria-controls="collapseDesc{{ $item->id }}">
                            <i class="fas fa-eye"></i> Lihat Selengkapnya
                        </button>

                        {{-- Deskripsi penuh --}}
                        <div class="collapse mt-2" id="collapseDesc{{ $item->id }}">
                            <div class="card card-body">
                                {{ $item->deskripsi }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('portofolio.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Script Bootstrap (pastikan ini ada di layout utama juga) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
