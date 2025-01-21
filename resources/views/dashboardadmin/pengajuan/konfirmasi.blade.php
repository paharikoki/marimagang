@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengajuan Dikonfirmasi</h4>
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
                        <a href="#">Pengajuan Dikonfirmasi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Pengajuan Dikonfirmasi</h4>
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
                                            <th>Action</th>
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
                                            <td>
                                                @if($p->status == 'Diterima')
                                                <span class="badge badge-success">{{ $p->status }}</span>
                                                @elseif($p->status == 'Ditolak')
                                                <span class="badge badge-danger">{{ $p->status }}</span>
                                                @else
                                                <span class="badge badge-secondary">{{ $p->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if($p->status == 'Ditolak')
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#lihatKomentarModal{{ $p->id }}">
                                                            Lihat Komentar
                                                        </button>
                                                        @else
                                                        <a class="dropdown-item" href="/userdetailadmin/{{ $p->id }}">
                                                            Lihat Detail User
                                                        </a>

                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#diterimaadmin{{ $p->id }}">
                                                            Diterima
                                                        </a>

                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Modal Diterima -->
                                            <div class="modal fade" id="diterimaadmin{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Penerimaan Mahasiswa Magang</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="/diterimaadmin/{{ $p->id }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method("put")
                                                            <div class="modal-body">
                                                                <p style="font-size: 18px;">Apakah Anda yakin untuk menerima <strong>{{ $p->user->nama }}</strong> ini untuk magang di <strong>{{ $p->databidang->nama }}</strong>?</p>
                                                                <input type="hidden" name="user_id" value="{{ $p->user_id }}">
                                                                <div class="form-group">
                                                                    <label for="kesediaan">Upload Surat Rekomendasi Kesediaan PKL (PDF)</label>
                                                                    <input type="file" class="form-control @error('kesediaan') is-invalid @enderror" id="kesediaan" name="kesediaan" accept=".pdf">
                                                                    @error('kesediaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
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
                                                                <button type="submit" class="btn btn-success">Ya, Terima</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                        <!-- Modal Lihat Komentar -->
                                        <div class="modal fade" id="lihatKomentarModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Alasan Penolakan Pengajuan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{!! $p->komentar !!}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
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