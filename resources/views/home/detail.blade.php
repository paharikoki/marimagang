@extends('home.layouts.maindetail')

@section('content')
<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6>Detail</h6>
                <h2>Bidang Kerja Kominfo</h2>
            </div>
        </div>
    </div>
</section>

<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="meeting-single-item">
                            <div class="thumb">
                                <a href="#"><img src="{{ asset('storage/' . $databidang->photo) }}" alt="" style="width: 100%; height: auto;"></a>
                            </div>
                            <div class="down-content">
                                @foreach($skill as $s)
                                <span style="display: inline-block; padding: 5px 10px; background-color: #343a40; color: #fff; border-radius: 10px; margin-right: 10px; margin-bottom: 5px;">{{ $s->nama }}</span>
                                @endforeach
                                <hr style="border-top: 3px solid #000;">
                                <span style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                                    <h4 style="margin-right: 10px;">{{ $databidang->nama }}</h4>
                                    @if ($databidang->status == 'Buka')
                                    <span class="badge bg-success" style="border: 1px solid #000; padding: 5px 10px;">{{ $databidang->status }}</span>
                                    @elseif ($databidang->status == 'Tutup')
                                    <span class="badge bg-danger" style="border: 1px solid #000; padding: 5px 10px;">{{ $databidang->status }}</span>
                                    @endif
                                </span>

                                <p>{!! $databidang->deskripsi !!}</p>
                                <hr style="border-top: 3px solid #000;">

                                <h3 style="text-align: center;">DATA PESERTA MAGANG</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-4">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Tanggal Mulai</th>
                                                <th class="text-center">Tanggal Selesai</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pengajuan as $p)
                                            <tr>
                                                <td class="text-center">{{ $p->user->nama }}</td>
                                                <td class="text-center">{{ $p->tanggalmulai }}</td>
                                                <td class="text-center">{{ $p->tanggalselesai }}</td>
                                                <td class="text-center"><span class="badge bg-success">{{ $p->status }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination justify-content-center mt-4">
                                    {{ $pengajuan->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="main-button-red">
                            <a href="/marimagang">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Copyright © 2023 <br> Dinas Komunikasi dan Informatika Kabupaten Malang</p>
    </div>
</section>
@endsection