@extends('layout.v_template2')

@section('title', 'Ubah Profile')
@section('sidebar-title', 'Profile')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="profile-card">
      <h2 class="mb-3"><i class="fas fa-user-cog me-2"></i>Profile Admin</h2>
      <hr>

      <!-- Pesan sukses -->
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" value="********" readonly>
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-6 text-center">
    <img src="{{ $user->foto ? asset('assets/img/'.$user->foto) : asset('assets/img/admin tea.jpg') }}" 
         alt="Foto Profil" class="rounded-circle" width="200" height="200">
    <h3 class="mt-3">{{ $user->username ?? 'Nama Pengguna' }}</h3>
    <p class="text-muted">Akun Saya</p>
  </div>
</div>

  </div>
</div>
@endsection
