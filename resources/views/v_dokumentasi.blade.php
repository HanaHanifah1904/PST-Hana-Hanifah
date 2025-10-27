@extends('layout.v_template2')

@section('title', 'Dokumentasi')
@section('sidebar-title', 'Dokumentasi')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-folder-open me-2"></i> Upload Dokumentasi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Upload --}}
    <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
            </div>
            <div class="col-md-3 mb-3">
                <select name="jenis" class="form-control" id="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="foto">Foto</option>
                    <option value="pdf">PDF</option>
                    <option value="video">Video (Embed)</option>
                </select>
            </div>
            <div class="col-md-3 mb-3" id="fileUpload">
                <input type="file" name="file_path" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="col-md-6 mb-3 d-none" id="videoInput">
                <input type="text" name="video_link" class="form-control" placeholder="Masukkan link embed YouTube (contoh: https://www.youtube.com/embed/abc123)">
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-upload me-2"></i>Upload</button>
    </form>

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

    {{-- Daftar Dokumentasi --}}
    <h4 class="mb-3"><i class="fas fa-images me-2"></i>Daftar Dokumentasi</h4>
    <section class="dokumentasi mt-5">
        <div class="row">
            @forelse($dokumentasi as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        
                        {{-- Video --}}
                        @if(!empty($item->video_link))
                            <iframe 
                                width="100%" 
                                height="220" 
                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($item->video_link, 'v=') }}" 
                                frameborder="0" 
                                allowfullscreen>
                            </iframe>

                        {{-- Foto --}}
                        @elseif($item->jenis == 'foto')
                            <img src="{{ asset($item->file_path) }}" class="card-img-top" style="height:220px; object-fit:cover;">

                        {{-- PDF --}}
                        @elseif($item->jenis == 'pdf')
                            <iframe src="{{ asset($item->file_path) }}" width="100%" height="220"></iframe>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>

                            <p class="card-text">{{ $item->deskripsi }}</p>

                            {{-- Tombol Edit & Hapus --}}
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
                </div>
            @empty
                <p class="text-muted">Tidak ada file untuk ditampilkan.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection
