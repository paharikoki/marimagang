@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Akun</h4>
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
                        <a href="#">Data Akun</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Mahasiswa</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Akun Mahasiswa</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>NIM</th>
                                            <th>Email</th>
                                            <th>Dibuat Pada</th>
                                            <th>Status Akun</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>NIM</th>
                                            <th>Email</th>
                                            <th>Dibuat Pada</th>
                                            <th>Status Akun</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->nim }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($u->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</td>

                                            <td>

                                                @if( $u->verify == 0)
                                                <a href="/verify/{{ $u->id }}">
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fas fa-user-slash"></i> Block
                                                    </button>
                                                </a>

                                                @else

                                                <a href="/block/{{ $u->id }}" class="block-button-mahasiswa">
                                                    <button type="button" class="btn btn-success">
                                                        <i class="fas fa-user-check"></i> Terverifikasi
                                                    </button>
                                                </a>
                                                @endif
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
