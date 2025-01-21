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
                        <a href="#">Prodi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Prodi</h4>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addOrderModal">
                                    <button class="btn btn-danger">
                                        <span class="btn-label">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        Tambah Prodi
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="modal fade" id="addOrderModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Data Prodi</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('prodipost') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Prodi</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi" id="nama_prodi" placeholder="Nama Prodi" value="{{ old('nama_prodi') }}" />

                                                    @error('nama_prodi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Prodi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Prodi</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($prodi as $a)
                                        <tr>
                                            <td>{{ $a->id }}</td>
                                            <td>{{ $a->nama_prodi }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="/prodiupdate/{{ $a->id }}" style="margin-right: 10px;" data-toggle="modal" data-target="#edit-{{ $a->id }}">
                                                        <button type="button" class="btn btn-icon btn-round btn-info">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </a>
                                                    <a href="/prodidelete/{{ $a->id }}" class="delete-button-admin" data-confirm-delete="true">
                                                        <button type="button" class="btn btn-icon btn-round btn-danger">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Prodi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="container-fluid">

                                                            <form method="POST" action="/prodiupdate/{{ $a->id }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method("put")
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Nama Prodi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $a->nama_prodi) }}" />

                                                                        @error('nama_prodi')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-3">
                                                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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