@extends('mahasiswa.layouts.mainupload')

@section('content')
<div class="container-fluid px-0" id="bg-div">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">
            <div class="card card0">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="bg-light border-right" id="sidebar-wrapper">
                        <div class="sidebar-heading pt-5 pb-4">
                            <strong>DATA ANGGOTA</strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item active1">
                                <div class="list-div my-2">
                                    <div class="fa fa-users"></div> &nbsp;&nbsp; Kelola Anggota
                                </div>
                            </a>
                        </div>
                    </div>

                    <div id="page-content-wrapper">
                        <div class="row pt-3" id="border-btm">
                            <div class="col-4">
                                <button class="btn btn-danger mt-4 ml-3 mb-3" id="menu-toggle">
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                </button>
                            </div>
                            <div class="col-8">
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 mt-4 text-right" style="font-weight: bold;">
                                            {{ $user->nama }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 text-right">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                        </div>

                        <div class="tab-content">
                            <div id="menu1" class="tab-pane in active">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h4 class="mt-0 mb-4 text-center">DATA ANGGOTA MAGANG</h4>
                                            <div class="main">

                                                <div class="container">
                                                    <button type="button" class="btn btn-danger float-right mb-3" data-toggle="modal" data-target="#add">
                                                        + Tambah Data
                                                    </button>

                                                    <!-- Modal Untuk Tambah Anggota -->
                                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah
                                                                        Anggota</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="{{ route('tambah.anggota', ['id' => $user->id]) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id_pengajuan" value="{{ request()->query('id_pengajuan') }}">
                                                                    <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
                                                                    <div class="modal-body">
                                                                        <div class="form-row">
                                                                            <div class="form-group">
                                                                                <label for="previous_name">Nama:</label>
                                                                                <input type="text" name="nama" id="nama" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="previous_image">NIM:</label>
                                                                                <input type="text" name="nim" id="nim" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Nama</th>
                                                                <th class="text-center">NIM</th>
                                                                <th class="text-center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->anggota as $anggota)
                                                            <tr>
                                                                <td class="text-center">{{ $anggota->nama }}</td>
                                                                <td class="text-center">{{ $anggota->nim }}</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-{{ $anggota->id }}">
                                                                        Edit
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{ $anggota->id }}">
                                                                        Delete
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            <!-- Modal Untuk Edit Anggota -->
                                                            <div class="modal fade" id="edit-{{ $anggota->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('edit.anggota', ['id' => $anggota->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="hidden" name="user_id" value="{{ $anggota->user_id }}">
                                                                                <div class="form-row">
                                                                                    <div class="form-group">
                                                                                        <label for="nama">Nama:</label>
                                                                                        <input type="text" name="nama" id="nama" value="{{ $anggota->nama }}" />
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="nim">NIM:</label>
                                                                                        <input type="text" name="nim" id="nim" value="{{ $anggota->nim }}" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal Untuk Menghapus Data Anggota -->
                                                            <div class="modal fade" id="delete-{{ $anggota->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda Yakin Ingin Menghapus Data Ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                            <form action="{{ route('delete.anggota', ['id' => $anggota->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="hidden" name="user_id" value="{{ $anggota->user_id }}">
                                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                                            </form>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.toggle-card').click(function() {
            var cardBody = $(this).siblings('.card-body');
            cardBody.slideToggle();
        });
    });
</script>
@endpush