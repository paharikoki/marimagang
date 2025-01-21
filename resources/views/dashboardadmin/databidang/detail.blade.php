@extends('dashboardadmin.layouts.main')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kelola Konten</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/dashboardadmin/{{ auth()->user()->id }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Kelola Konten</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Landing Page</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail Konten</a>
                    </li>
                </ul>
            </div>

            <div class="container">
                <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-md-8">
                        <div class="card card-post card-round" style="border-radius: 20px; overflow: hidden;">
                            <div class="card-img-top">
                                <img src="{{ asset('storage/' . $databidang->photo) }}" alt="Card image cap" style="width: 100%; height: auto; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            </div>
                            <div class="card-body">
                                @foreach($skill as $s)
                                <span class="badge badge-dark">{{ $s->nama }}</span>
                                @endforeach
                                <div class="separator-solid"></div>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $databidang->nama }}
                                    </a>
                                </h3>
                                <br><br>
                                <p class="description">
                                    {!! $databidang->deskripsi !!}
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="/databidang/{{ $databidang->admin_id }}" class="btn btn-round" style="color: black; background-color: white; border: 1px solid black;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection