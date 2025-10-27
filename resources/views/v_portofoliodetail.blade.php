<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $portofolio->judul ?? 'Detail Portofolio' }} | PT Nusantara Tech</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Poppins', sans-serif;
      color: #333;
      overflow-x: hidden;
    }

    /* Navbar biru */
    .navbar {
      background-color: #003399;
      padding: 12px 0;
    }
    .navbar-brand {
      color: #fff !important;
      font-weight: 700;
      font-size: 1.3rem;
      letter-spacing: 0.5px;
    }
    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin-left: 22px;
      transition: 0.3s;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #ffcc00 !important;
    }

    /* Artikel full-width, tanpa white bg */
    .article {
      max-width: 980px;
      margin: 110px auto 60px;
      padding: 0;
    }
    .article h1 {
      color: #003399;
      font-weight: 700;
      line-height: 1.3;
      margin-bottom: 15px;
    }
    .meta {
      color: #6c757d;
      font-size: 0.95rem;
      margin-bottom: 25px;
    }

    /* Gambar hero proporsional, lebih kecil, center */
    .hero-img {
      width: 80%;        /* ukuran foto lebih kecil */
      height: auto;      /* proporsional */
      border-radius: 0;
      margin-bottom: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto; /* center */
      transition: transform 0.4s ease;
    }
    .hero-img:hover {
      transform: scale(1.02);
    }

    .content {
      font-size: 1.1rem;
      line-height: 1.9;
      text-align: justify;
      color: #444;
      margin-bottom: 35px;
      padding: 0 15px;
    }

    /* Tombol kembali */
    .btn-outline-primary {
      border-color: #003399;
      color: #003399;
      font-weight: 500;
      border-radius: 30px;
      padding: 8px 20px;
    }
    .btn-outline-primary:hover {
      background-color: #003399;
      color: #fff;
    }

    /* Footer */
    footer {
      background: #003399;
      color: #fff;
      text-align: center;
      padding: 20px;
      margin-top: 70px;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .article {
        margin: 20px auto;
      }
      .hero-img {
        width: 95%; /* lebih besar di mobile supaya tetap terlihat */
      }
      .content {
        padding: 0 10px;
      }
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('halaman') }}">PT NUSANTARA TECH</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('halaman') }}#beranda">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('halaman') }}#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('halaman') }}#layanan">Layanan</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('halaman') }}#portfolio">Portofolio</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('halaman') }}#dokumentasi">Dokumentasi</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('halaman') }}#kontak">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Konten Portofolio --}}
  <article class="article">
    <h1>{{ $portofolio->judul }}</h1>
    <div class="meta">
      <i class="bi bi-calendar-event"></i>
      {{ \Carbon\Carbon::parse($portofolio->created_at)->translatedFormat('d F Y') }}
    </div>

    @if(!empty($portofolio->foto_path))
      <img src="{{ asset($portofolio->foto_path) }}" alt="{{ $portofolio->judul }}" class="hero-img">
    @endif

    <div class="content">
      {!! nl2br(e($portofolio->deskripsi)) !!}
    </div>

    <a href="{{ route('halaman') }}#portfolio" class="btn btn-outline-primary">
      <i class="bi bi-arrow-left"></i> Kembali ke Portofolio
    </a>
  </article>

  {{-- Footer --}}
  <footer>
    <p class="mb-0">&copy; {{ date('Y') }} PT Nusantara Tech. Semua Hak Dilindungi.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
