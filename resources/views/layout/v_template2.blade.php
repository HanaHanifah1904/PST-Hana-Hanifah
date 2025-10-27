<!doctype html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    html[data-theme='light'] {
      --bg-color: #f4f7fd;
      --sidebar-bg: #0B2447;
      --card-color: rgba(255,255,255,0.95);
      --text-color: #0B2447;
      --btn-primary: #0B2447;
      --btn-hover: #031634;
    }
    html[data-theme='dark'] {
      --bg-color: #0B2447;
      --sidebar-bg: #19376D;
      --card-color: rgba(25,55,109,0.85);
      --text-color: #f0f4f8;
      --btn-primary: #19376D;
      --btn-hover: #031634;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      font-family: 'Poppins', sans-serif;
      transition: 0.3s;
    }

    .sidebar {
      background: var(--sidebar-bg);
      min-height: 100vh;
      padding: 2rem 1rem;
      color: #fff;
      position: fixed;
      width: 220px;
      transition: 0.3s;
    }
    .sidebar h3 { font-weight: 600; margin-bottom: 2rem; }
    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 0.6rem 1rem;
      border-radius: 0.5rem;
      margin-bottom: 0.4rem;
      transition: 0.2s;
    }
    .sidebar a:hover { background: rgba(255,255,255,0.1); }

    .main-content { margin-left: 240px; padding: 2rem; }
    .profile-card, .content-card {
      background: var(--card-color);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      backdrop-filter: blur(10px);
      margin-bottom: 2rem;
    }

    .form-control { border-radius: 0.6rem; border: none; padding: 0.7rem 1rem; transition: 0.3s; }
    .form-control:focus { box-shadow: 0 0 0 0.2rem rgba(11,36,71,0.3); }

    .btn-primary { background: var(--btn-primary); border: none; border-radius: 0.6rem; transition: 0.3s; }
    .btn-primary:hover { background: var(--btn-hover); }

    .theme-toggle { position: fixed; top: 20px; right: 20px; cursor: pointer; font-size: 1.5rem; color: var(--text-color); }
  </style>
</head>
<body>

<div class="theme-toggle" id="themeToggle"><i class="fas fa-moon"></i></div>

<!-- Sidebar -->
<div class="sidebar">
  <h3>@yield('sidebar-title', 'Dashboard')</h3>
  <a href="{{ route('profile') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
  <a href="{{ route('dashboard.edit') }}"><i class="fas fa-user-edit me-2"></i>Ubah Profile</a>
  <a href="{{ route('dokumentasi.index') }}"><i class="fas fa-folder-open me-2"></i>Dokumentasi</a>
  <a href="{{ route('portofolio.index') }}"><i class="fas fa-images me-2"></i>Layanan Kami</a>
  <a href="{{ route('tentangkami.index') }}"><i class="fas fa-info-circle me-2"></i> Tentang Kami</a>
  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt me-2"></i>Logout
  </a>
</div>

<!-- Main Content -->
<div class="main-content">
  @yield('content')
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

<script>
  const toggle = document.getElementById('themeToggle');
  const html = document.documentElement;
  toggle.addEventListener('click', () => {
    if(html.getAttribute('data-theme') === 'light') {
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
