@extends('layout.v_template')

@section('content')
<div class="container mt-5">
    <h1>Dashboard</h1>
    <p>Halo, {{ auth()->user()->name }}! Selamat datang di dashboard.</p>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection
