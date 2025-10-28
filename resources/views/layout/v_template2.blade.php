<!doctype html>
<html lang="id" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title', 'Dashboard')</title>

  <!-- SB Admin 2 Assets -->
  <link href="{{ asset('Template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
  <link href="{{ asset('Template') }}/css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    /* ======== Tema Utama (Dark/Light) ======== */
    html[data-theme='light'] {
      --bg-color: #f8f9fc;
      --sidebar-bg: #0B2447;
      --card-bg: #ffffff;
      --text-color: #0B2447;
      --btn-primary: #0B2447;
      --btn-hover: #031634;
    }
    html[data-theme='dark'] {
      --bg-color: #0B2447;
      --sidebar-bg: #19376D;
      --card-bg: rgba(25,55,109,0.9);
      --text-color: #f0f4f8;
      --btn-primary: #19376D;
      --btn-hover: #031634;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      font-family: 'Nunito', sans-serif;
      transition: 0.3s ease;
    }

    /* ======== Sidebar Kustom (Tetap Dipertahankan) ======== */
    .sidebar {
      background: var(--sidebar-bg);
      min-height: 100vh;
      padding: 2rem 1rem;
      color: #fff;
      position: fixed;
      width: 240px;
      transition: 0.3s;
      box-shadow: 4px 0 20px rgba(0,0,0,0.2);
      backdrop-filter: blur(10px);
      z-index: 1030;
    }
    .sidebar h3 { font-weight: 700; margin-bottom: 2rem; }
    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 0.7rem 1rem;
      border-radius: 0.5rem;
      margin-bottom: 0.4rem;
      transition: 0.2s;
      font-weight: 500;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.2);
      transform: translateX(5px);
    }

    /* ======== Konten Utama ======== */
    .main-content {
      margin-left: 260px;
      padding: 2rem;
      min-height: 100vh;
    }

    .content-card {
      background: var(--card-bg);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 6px 25px rgba(0,0,0,0.2);
      backdrop-filter: blur(10px);
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .theme-toggle {
      position: fixed;
      top: 20px;
      right: 25px;
      cursor: pointer;
      font-size: 1.5rem;
      color: var(--text-color);
      z-index: 2000;
    }
  </style>
</head>

<body id="page-top">

  <!-- Tombol Dark/Light Mode -->
  <div class="theme-toggle" id="themeToggle"><i class="fas fa-moon"></i></div>

  <!-- Wrapper Utama -->
  <div id="wrapper">

    <!-- Sidebar Custom -->
    <div class="sidebar">
      <h3>@yield('sidebar-title', 'Dashboard')</h3>
      <a href="{{ route('profile') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
      <a href="{{ route('dashboard.edit') }}"><i class="fas fa-user-edit me-2"></i>Ubah Profil</a>
      <a href="{{ route('dokumentasi.index') }}"><i class="fas fa-folder-open me-2"></i>Dokumentasi</a>
      <a href="{{ route('portofolio.index') }}"><i class="fas fa-images me-2"></i>Layanan Kami</a>
      <a href="{{ route('tentangkami.index') }}"><i class="fas fa-info-circle me-2"></i>Tentang Kami</a>
      <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
      </a>
    </div>

    <!-- Konten SB Admin 2 -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" class="main-content">

        <!-- Topbar SB Admin 2 -->
        @include('layout.v_topbar')

        <!-- Halaman Utama -->
        @yield('content')

      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white text-center py-3">
        <div class="container my-auto">
          <span>Copyright &copy; PT Nusantara Tech {{ date('Y') }}</span>
        </div>
      </footer>

    </div>
  </div>

  <!-- Logout Form -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

  <!-- Script SB Admin 2 -->
  <script src="{{ asset('Template') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('Template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('Template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{ asset('Template') }}/js/sb-admin-2.min.js"></script>

  <!-- Chart JS (Optional) -->
  <script src="{{ asset('Template') }}/vendor/chart.js/Chart.min.js"></script>
  <script src="{{ asset('Template') }}/js/demo/chart-area-demo.js"></script>
  <script src="{{ asset('Template') }}/js/demo/chart-pie-demo.js"></script>

  <!-- Script Toggle Mode -->
  <script>
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    toggle.addEventListener('click', () => {
      if (html.getAttribute('data-theme') === 'light') {
        html.setAttribute('data-theme', 'dark');
        toggle.innerHTML = '<i class="fas fa-sun"></i>';
      } else {
        html.setAttribute('data-theme', 'light');
        toggle.innerHTML = '<i class="fas fa-moon"></i>';
      }
    });
  </script>

</body>
</html>
