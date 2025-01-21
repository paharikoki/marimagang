@extends('notifikasi.layouts.main')

@section('content')

<!-- Navbar -->
<nav class="navbar navbar-transparent navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/marimagang">
                        <i class="fa fa-home"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="/forms">
                        <i class="fa fa-user"></i>
                        Login / Register
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!-- Content -->
<div class="main" style="background-image: url('{{ asset('assets/images/bg-malang.jpg') }}');">
    <div class="cover black" data-color="black"></div>
    <div class="container">
        <h1 class="logo">
            <span class="spinner">
                <i class="fa fa-clock-o fa-spin"></i>
            </span>
        </h1>
        <div class="content">
            {{-- <p style="color:white;">{{ $user }}</p> --}}
            <p style="color: white; font-size: 24px; font-weight: 300; text-align: center; z-index: 3; margin-top: 40px;">Akun anda dengan email : {{ $user->email }} belum diverifikasi oleh admin</p>
            <h4 class="motto">Tunggu sampai admin memverifikasi akun anda</h4>
        </div>
    </div>
</div>
@endsection
