<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT Nusantara Tech</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      background-color: #0b3d91;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .navbar-brand, .nav-link {
      color: white !important;
    }
    .nav-link:hover {
      color: #ffc107 !important;
    }

    /* Hero */
    .hero {
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                  url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1500&q=80') no-repeat center center/cover;
      color: white;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .btn-custom {
      background-color: #ffc107;
      color: black;
      font-weight: bold;
      border-radius: 30px;
      transition: 0.3s;
    }

    .btn-custom:hover {
      background-color: #ffca28;
      transform: scale(1.05);
    }

    /* Section Title */
    section h2 {
      font-weight: bold;
      color: #0b3d91;
      border-left: 5px solid #ffc107;
      padding-left: 10px;
      margin-bottom: 20px;
    }

    /* Card */
    .card-custom {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .card-custom:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    /* Footer */
    footer {
      background-color: #0b3d91;
      color: white;
      text-align: center;
      padding: 30px 0;
    }
    footer a {
      color: #ffc107;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">PT NUSANTARA TECH</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
          <li class="nav-item"><a class="nav-link" href="#portofolio">Portofolio</a></li>
          <li class="nav-item"><a class="nav-link" href="#dokumentasi">Dokumentasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          <li class="nav-item">
            <a href="/login" class="btn btn-warning btn-sm ms-2 fw-bold">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section id="beranda" class="hero">
    <div class="container">
      <h1 class="mb-3">Solusi Teknologi Terbaik Untuk Bisnis Anda</h1>
      <p class="mb-4">Kami menghadirkan inovasi digital untuk mendukung kemajuan perusahaan Anda.</p>
      <a href="#tentang" class="btn btn-custom px-4 py-2">Pelajari Lebih Lanjut</a>
    </div>
  </section>

  <!-- Tentang -->
  <section id="tentang" class="py-5">
  <div class="container">
    <h2 class="mb-4 fw-bold text-primary">Tentang Perusahaan</h2>

    @if($tentangKami)
      <div class="row align-items-center">
        <!-- Deskripsi (kiri) -->
        <div class="col-md-6">
          <h3 class="fw-bold mb-3">{{ $tentangKami->judul }}</h3>
          <p style="white-space: pre-line; font-size: 1rem; line-height: 1.6; text-align: justify;">
            {!! nl2br(e($tentangKami->deskripsi)) !!}
          </p>
        </div>

        <!-- Foto (kanan) -->
        <div class="col-md-6 text-center">
          <img
            src="{{ asset('storage/' . $tentangKami->foto) }}"
            class="img-fluid rounded shadow"
            alt="Foto Tentang Kami"
            style="max-width: 100%; height: 400px; object-fit: cover;"
          >
        </div>
      </div>
    @else
      <p class="text-muted">Belum ada informasi Tentang Kami.</p>
    @endif
  </div>
</section>

<!-- Layanan Kami -->
<section id="portfolio" class="py-5" style="background-color: #fff;">
  <div class="container">
  <h2 class="mb-4 fw-bold text-primary">Layanan Kami</h2>

    @if($portofolio->isEmpty())
      <p class="text-center text-muted">Belum ada Layanan Kami yang ditampilkan</p>
    @else
      <div class="row g-4">
        @foreach($portofolio as $item)
          <div class="col-md-4 col-sm-6">
            {{-- Kartu portofolio --}}
            <a href="{{ route('portofolio.detail', $item->id) }}" class="text-decoration-none text-dark">
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 portfolio-card position-relative">
                
                {{-- 🖼️ Foto (fix biar muncul) --}}
                <img src="{{ asset($item->foto_path) }}" 
                     class="card-img" 
                     alt="{{ $item->judul }}" 
                     style="height: 250px; object-fit: cover; width:100%;">
                
                {{-- 🔲 Overlay teks di atas gambar --}}
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3" 
                     style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                  <h5 class="card-title text-white fw-bold mb-1">{{ $item->judul }}</h5>
                  <p class="card-text text-light small mb-0">{{ Str::limit($item->deskripsi, 80) }}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  {{-- ✨ Style tambahan --}}
  <style>
    .portfolio-card {
      transition: all 0.3s ease;
    }
    .portfolio-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .portfolio-card img {
      transition: transform 0.4s ease;
    }
    .portfolio-card:hover img {
      transform: scale(1.05);
    }
    a.text-decoration-none:hover .card-title {
      color: #ffc107;
    }

    @media (max-width: 767px) {
      .portfolio-card img {
        height: 200px;
      }
    }
  </style>
</section>

 <!-- Dokumentasi -->
 <section id="dokumentasi" class="py-5" style="background-color: white;">
  <div class="container">
    <h2 class="mb-4">Dokumentasi Kegiatan</h2>

    @if($dokumentasi->isEmpty())
      <p class="text-center text-muted">Tidak ada dokumentasi untuk ditampilkan.</p>
    @else
    
      {{-- Bagian FOTO --}}
      @if($dokumentasi->where('jenis', 'foto')->isNotEmpty())
      <h5 class="fw-bold mb-3 mt-5">Berita</h5>
        <div class="row flex-column gap-4">
          @foreach($dokumentasi->where('jenis', 'foto') as $item)
            <div class="col-12">
              <div class="card border-0 shadow-sm bg-white">
                <div class="row g-0 align-items-center">
                  
                  {{-- Konten Teks --}}
                  <div class="col-md-8 p-4">
                    <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                  </div>

                  {{-- Gambar Thumbnail --}}
                  <div class="col-md-4 d-flex justify-content-center align-items-center p-3">
                    @if(!empty($item->file_path))
                      <img src="{{ asset($item->file_path) }}"
                          class="img-thumbnail rounded"
                          style="max-width: 240px; max-height: 160px; object-fit: cover; background-color: #fff; border: 1px solid #dee2e6;"
                          alt="{{ $item->judul }}">
                    @endif
                  </div>

                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      {{-- Bagian PDF --}}
      @if($dokumentasi->where('jenis', 'pdf')->isNotEmpty())
        <h5 class="fw-bold mb-3 mt-5">Dokumen</h5>
        <div class="row">
          @foreach($dokumentasi->where('jenis', 'pdf') as $item)
            <div class="col-md-4 mb-4">
              <div class="card shadow-sm" style="background-color: #fef9f0;">
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                  <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                  @if(!empty($item->file_path))
                    <a href="{{ asset($item->file_path) }}" class="btn btn-outline-primary btn-sm" download>
                      <i class="bi bi-file-earmark-arrow-down"></i> Unduh Dokumen
                    </a>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      {{-- Bagian VIDEO --}}
      @if($dokumentasi->where('jenis', 'video')->isNotEmpty())
        <h5 class="fw-bold mb-3 mt-5">Video</h5>
        <div class="row">
          @foreach($dokumentasi->where('jenis', 'video') as $item)
            <div class="col-md-4 mb-4">
              <div class="card shadow-sm" style="background-color: #fef9f0;">
                <div class="card-body">
                  @php
                    if (Str::contains($item->video_link, 'watch?v=')) {
                        $embed = str_replace('watch?v=', 'embed/', $item->video_link);
                    } elseif (Str::contains($item->video_link, 'youtu.be')) {
                        $embed = str_replace('youtu.be/', 'www.youtube.com/embed/', $item->video_link);
                    } else {
                        $embed = $item->video_link;
                    }
                  @endphp

                  <div class="ratio ratio-16x9 mb-3">
                    <iframe src="{{ $embed }}" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                  <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

    @endif
  </div>
</section>

  <!-- Kontak -->
  <section id="kontak" class="py-5" style="background-color: #007bff; color: white;">
  <div class="container">
    <h2>Hubungi Kami</h2>
    <p>Ingin bekerja sama dengan kami? Silakan hubungi tim kami melalui kontak berikut.</p>
    <p><i class="bi bi-envelope"></i> info@nusantaratech.co.id</p>
    <p><i class="bi bi-telephone"></i> +62 812 3456 7890</p>
    <p><i class="bi bi-geo-alt"></i> Jl. Merdeka No. 123, Jakarta</p>
  </div>
</section>

<!-- Footer -->
<footer style="background-color: #0069d9; color: white; text-align: center; padding: 15px 0;">
  <p>&copy; 2025 PT Nusantara Tech. All rights reserved. | 
    <a href="#" style="color: #ffdd57; text-decoration: underline;">Kebijakan Privasi</a>
  </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('content')

</body>
</html>
