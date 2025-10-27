@extends('layout.v_template')

@section('content')
<div class="container text-center mt-5">
    <h1>Selamat Datang di Sistem Dashboard</h1>
    <p>Silakan login atau register untuk masuk dashboard</p>
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success">Register</a>
    @else
        <a href="{{ route('dashboard') }}" class="btn btn-warning">Masuk Dashboard</a>
    @endguest
</div>
@endsection
