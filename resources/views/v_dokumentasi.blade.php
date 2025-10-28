@extends('layout.v_template2')

@section('title', 'Dokumentasi')
@section('sidebar-title', 'Dokumentasi')

@section('content')
<style>
/* === STYLE UMUM === */
.gallery-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: #fff;
}
.gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.gallery-img, .gallery-video iframe {
    width: 100%;
    height: 220px;
    border-radius: 12px;
    object-fit: cover;
}

/* === STYLE PDF === */
.gallery-pdf {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 160px;
    border-radius: 12px;
    background: #f8f9fc;
    border: 1px dashed #c4c4c4;
    color: #6c757d;
    flex-direction: column;
    padding: 15px;
}
.gallery-pdf i {
    font-size: 2.2rem;
    color: #dc3545;
    margin-bottom: 8px;
}
.gallery-pdf span {
    font-size: 0.95rem;
    font-weight: 600;
}
.gallery-pdf a {
    margin-top: 4px;
    font-size: 0.85rem;
    font-weight: 500;
    color: #dc3545;
}
.gallery-pdf a:hover {
    text-decoration: underline;
}

/* === TEKS DAN TOMBOL === */
.truncate {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 3rem;
}
.btn-link {
    color: #0d6efd;
    font-weight: 500;
    font-size: 0.9rem;
}
.btn-link:hover {
    text-decoration: underline;
}
.section-title {
    font-weight: 700;
    margin-top: 40px;
    margin-bottom: 20px;
}
</style>

<div class="container">

    {{-- === HEADER UPLOAD === --}}
    <h3 class="mb-4"><i class="fas fa-folder-open me-2"></i> Upload Dokumentasi</h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- === FORM UPLOAD === --}}
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                    </div>
                    <div class="col-md-3">
                        <select name="jenis" class="form-control" id="jenis" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="foto">Foto</option>
                            <option value="pdf">PDF</option>
                            <option value="video">Video (YouTube)</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="fileUpload">
                        <input type="file" name="file_path" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div class="col-md-6 d-none" id="videoInput">
                        <input type="text" name="video_link" class="form-control"
                            placeholder="Masukkan link YouTube (contoh: https://youtu.be/abc123 atau https://www.youtube.com/watch?v=abc123)">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-upload me-2"></i> Upload
                </button>
            </form>
        </div>
    </div>

    {{-- === BAGIAN FOTO === --}}
    <h4 class="section-title"><i class="fas fa-image me-2 text-primary"></i> Dokumentasi Foto</h4>
    <div class="row">
        @forelse($dokumentasi->where('jenis', 'foto') as $item)
            <div class="col-md-4 mb-4">
                <div class="gallery-card p-3 shadow-sm">
                    <img src="{{ asset($item->file_path) }}" class="gallery-img mb-3" alt="Foto Dokumentasi">
                    <h5 class="fw-bold">{{ $item->judul }}</h5>

                    <p class="card-text text-muted truncate mb-1">{{ $item->deskripsi }}</p>
                    <button class="btn btn-link p-0 text-decoration-none" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseDesc{{ $item->id }}"
                        aria-expanded="false"
                        aria-controls="collapseDesc{{ $item->id }}">
                        <i class="fas fa-eye"></i> Lihat Selengkapnya
                    </button>
                    <div class="collapse mt-2" id="collapseDesc{{ $item->id }}">
                        <div class="card card-body border-0 bg-light">
                            {{ $item->deskripsi }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dokumentasi.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada foto yang diunggah.</p>
        @endforelse
    </div>

    {{-- === BAGIAN PDF === --}}
    <h4 class="section-title"><i class="fas fa-file-pdf me-2 text-danger"></i> Dokumen PDF</h4>
    <div class="row">
        @forelse($dokumentasi->where('jenis', 'pdf') as $item)
            <div class="col-md-4 mb-4">
                <div class="gallery-card p-3 shadow-sm text-center">
                    <div class="gallery-pdf mb-3">
                        <i class="fas fa-file-pdf"></i>
                        <span>{{ $item->judul }}</span>
                        <a href="{{ asset($item->file_path) }}" target="_blank">
                            <i class="fas fa-eye"></i> Lihat PDF
                        </a>
                    </div>
                    <p class="text-muted small">{{ $item->deskripsi }}</p>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dokumentasi.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada dokumen PDF.</p>
        @endforelse
    </div>

    {{-- === BAGIAN VIDEO === --}}
    <h4 class="section-title"><i class="fas fa-video me-2 text-warning"></i> Dokumentasi Video</h4>
    <div class="row">
        @forelse($dokumentasi->where('jenis', 'video') as $item)
            @php
                $link = $item->video_link;
                if (str_contains($link, 'youtu.be/')) {
                    $videoId = \Illuminate\Support\Str::after($link, 'youtu.be/');
                } elseif (str_contains($link, 'v=')) {
                    $videoId = \Illuminate\Support\Str::after($link, 'v=');
                } elseif (str_contains($link, 'embed/')) {
                    $videoId = \Illuminate\Support\Str::after($link, 'embed/');
                } else {
                    $videoId = $link;
                }
                $videoId = strtok($videoId, '&');
            @endphp

            <div class="col-md-4 mb-4">
                <div class="gallery-card p-3 shadow-sm">
                    <div class="gallery-video mb-3">
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <h5 class="fw-bold">{{ $item->judul }}</h5>
                    <p class="text-muted">{{ $item->deskripsi }}</p>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dokumentasi.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada video yang diunggah.</p>
        @endforelse
    </div>

</div>

{{-- === SCRIPT DINAMIS === --}}
<script>
document.getElementById('jenis').addEventListener('change', function() {
    const fileUpload = document.getElementById('fileUpload');
    const videoInput = document.getElementById('videoInput');
    if (this.value === 'video') {
        fileUpload.classList.add('d-none');
        videoInput.classList.remove('d-none');
    } else {
        fileUpload.classList.remove('d-none');
        videoInput.classList.add('d-none');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
