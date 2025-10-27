@extends('layout.v_template2')

@section('title', 'Ubah Profile')
@section('sidebar-title', 'Profile')

@section('content')
<div class="row">
  <!-- Form Edit Profile -->
  <div class="col-md-6">
    <div class="profile-card">
      <h2 class="mb-3"><i class="fas fa-user-cog me-2"></i>Ubah Profile</h2>
      <hr>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}">
          @error('username') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Password Baru -->
        <div class="mb-3">
          <label for="password" class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
          <input type="password" name="password" class="form-control" id="password">
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
        </div>

        <!-- Upload Foto Profil -->
        <div class="mb-3">
          <label for="foto" class="form-label">Foto Profil</label>
          <input type="file" name="foto" class="form-control" id="foto" accept="image/*" onchange="previewFoto(event)">
          @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
      </form>
    </div>
  </div>

  <!-- Preview Foto & Info -->
  <div class="col-md-6 text-center">
    <img id="fotoPreview" src="{{ $user->foto ? asset('assets/img/'.$user->foto) : asset('assets/img/admin tea.jpg') }}" 
         alt="Foto Profil" class="rounded-circle" width="200" height="200">
    <h3 class="mt-3">{{ $user->username ?? 'Nama Pengguna' }}</h3>
    <p class="text-muted">Akun Saya</p>
  </div>
</div>

<script>
  function previewFoto(event) {
      const reader = new FileReader();
      reader.onload = function(){
          const output = document.getElementById('fotoPreview');
          output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
  }
</script>
@endsection
