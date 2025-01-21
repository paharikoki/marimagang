@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Magang</h4>
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
                        <a href="#">Magang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Magang</h4>
                                <a href="/pdfadmin" class="btn btn-sm btn-danger" style="color: white; text-decoration: none;"><i class="fa fa-download"></i> Cetak ke PDF</a>
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
                                            <th>Status Pengajuan</th>
                                            <th>Detail</th>
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
                                            <td>
                                                @if ($p->status === 'Magang')
                                                <span class="badge badge-success">{{ $p->status }}</span>
                                                @else
                                                <span class="badge badge-default">{{ $p->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/userdetailadmin/{{ $p->id }}">
                                                    <button type="button" class="btn btn-xs btn-info">
                                                        Profil
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($p->status === 'Magang')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">

                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#lihatKomentarModal{{ $p->id }}">
                                                            Lihat Komentar
                                                        </button>

                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#selesai{{ $p->id }}">
                                                            Selesaikan
                                                        </button>
                                                        @else
                                                        <span class="badge badge-default">Selesai</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <!-- Modal Lihat Komentar -->
                                        <div class="modal fade" id="lihatKomentarModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Komentar Penerimaan Magang</h5>
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

                                        <!-- Modal Selesai Magang -->
                                        <div class="modal fade" id="selesai{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Magang Mahasiswa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="/selesai" enctype="multipart/form-data">
                                                        @csrf
                                                        @method("put")
                                                        <div class="modal-body">
                                                            <p style="font-size: 18px;">Apakah Anda yakin untuk menyelesaikan magang <br> <strong>{{ $p->user->nama }}</strong> di <strong>{{ $p->databidang->nama }}</strong>?</p>
                                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                                            <input type="hidden" name="user_id" value="{{ $p->user_id }}">
                                                            <div class="form-group">
                                                                <label for="nilai">Upload Nilai Mahasiswa (.docx)</label>
                                                                <input type="file" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" accept=".docx">
                                                                @error('nilai')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="suratmagang">Upload Surat Selesai Magang (.pdf)</label>
                                                                <input type="file" class="form-control @error('suratmagang') is-invalid @enderror" id="suratmagang" name="suratmagang" accept=".pdf">
                                                                @error('suratmagang')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <br>
                                                            <p style="font-size: 18px;"><strong>Note :</strong> Pastikan Laporan Akhir Sudah Diupload</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Ya, Selesaikan</button>
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