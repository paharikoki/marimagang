@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pengajuan Magang</h4>
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
                        <a href="#">Data Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Permohonan Magang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Pengajuan Magang</h4>
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
                                            <th>Action</th>
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
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($pengajuan as $p)
                                        <tr>
                                            <td class="col-1">{{ $p->id }}</td>
                                            <td class="col-1">{{ $p->user->nama }}</td>
                                            <td class="col-3">{{ $p->tanggalmulai }}</td>
                                            <td class="col-3">{{ $p->tanggalselesai }}</td>
                                            <td class="col-1">{{ $p->databidang->nama }}</td>
                                            <td class="col-3"><span class="badge badge-warning">{{ $p->status }}</span></td>
                                            <td class="col-1">
                                                <a href="/userdetailbidang/{{ $p->id }}">
                                                    <button type="button" class="btn btn-xs btn-info">
                                                        Profil
                                                    </button>
                                                </a>
                                            </td>
                                            <td class="col-1">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-danger mr-1" data-toggle="modal" data-target="#ditolak{{ $p->id }}">
                                                        Ditolak
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#diterima{{ $p->id }}">
                                                        Diterima
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Diteruskan Ke Bidang -->
                                        <div class="modal fade" id="diterima{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Penerimaan Mahasiswa Magang</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="/diterimabidang/{{ $p->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method("put")
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id" value="{{ $p->user_id }}">
                                                            <p style="font-size: 18px;">Apakah Anda yakin untuk menerima <strong>{{ $p->user->nama }}</strong> ini untuk magang di <strong>{{ $p->databidang->nama }}</strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Ya, Terima</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ditolak Modal -->
                                        <div class="modal fade" id="ditolak{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Pengajuan Magang Ditolak</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="/ditolakbidang/{{ $p->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method("put")
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id" value="{{ $p->user_id }}">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Komentar</label>
                                                                <div class="col-sm-9">
                                                                    <textarea id="my-editor" class="my-editor form-control @error('komentar') is-invalid @enderror" name="komentar" id="komentar" placeholder="Komentar">{{ old('komentar') }}</textarea>

                                                                    @error('komentar')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Kirim Data</button>
                                                        </div>
                                                    </form>
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