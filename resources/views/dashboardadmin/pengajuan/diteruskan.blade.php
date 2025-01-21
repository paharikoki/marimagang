@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengajuan Ke Bidang</h4>
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
                        <a href="#">Data Permohonan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pengajuan Ke Bidang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Pengajuan Ke Bidang</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Bidang</th>
                                            <th>Status Pengajuan</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Bidang</th>
                                            <th>Status Pengajuan</th>
                                            <th>Detail</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($pengajuan as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->tanggalmulai }}</td>
                                            <td>{{ $p->tanggalselesai }}</td>
                                            <td>{{ $p->databidang->nama }}</td>
                                            <td><span class="badge badge-warning">{{ $p->status }}</span></td>
                                            <td>
                                                <a href="/userdetailadmin/{{ $p->id }}">
                                                    <button type="button" class="btn btn-xs btn-info">
                                                        Profil
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection