@extends('mahasiswa.layouts.mainlogbook')

@section('content')
<div class="container-fluid px-0" id="bg-div">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">
            <div class="card card0">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="bg-light border-right" id="sidebar-wrapper">
                        <div class="sidebar-heading pt-5 pb-4">
                            <strong>MENU LOGBOOK</strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item active1">
                                <div class="list-div my-2">
                                    <div class="fa fa-book"></div> &nbsp;&nbsp;&nbsp; Logbook Mahasiswa
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
                                        <h4 class="mt-0 mb-4 text-center">LOGBOOK MAHASISWA</h4>
                                        <div class="row justify-content-center">
                                            <div class="scrolling-container">
                                                @php
                                                    $months = [];
                                                @endphp

                                                @foreach ($tanggallogbook as $l)
                                                    @php
                                                        $logbookData = $logbook->where('tanggal', $l)->first();
                                                        $headerBackground = $logbookData ? 'background-color: #DC143C;' : '';
                                                        $headerTextColor = $logbookData ? 'color: white;' : '';
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $logbookDate = \Carbon\Carbon::parse($l);
                                                        if ($logbookDate->isFuture() || ($logbookDate->isToday() && $currentDate->hour < 23)) {
                                                            continue;
                                                        }
                                                        $month = $logbookDate->format('F Y'); // Extract the month and year for grouping
                                                        if (!isset($months[$month])) {
                                                            $months[$month] = [];
                                                        }
                                                        $months[$month][] = $l;
                                                    @endphp
                                                @endforeach

                                                <!-- Tab Navigation -->
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    @foreach ($months as $month => $dates)
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ str_replace(' ', '-', $month) }}-tab" data-toggle="tab" href="#tab-{{ str_replace(' ', '-', $month) }}" role="tab" aria-controls="tab-{{ str_replace(' ', '-', $month) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                                {{ \Carbon\Carbon::parse($dates[0])->locale('id_ID')->isoFormat('MMMM YYYY') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <!-- Tab Content -->
                                                <div class="tab-content" id="myTabContent">
                                                    @foreach ($months as $month => $dates)
                                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ str_replace(' ', '-', $month) }}" role="tabpanel" aria-labelledby="tab-{{ str_replace(' ', '-', $month) }}-tab">
                                                            @foreach ($dates as $l)
                                                                @php
                                                                    $logbookData = $logbook->where('tanggal', $l)->first();
                                                                    $headerBackground = $logbookData ? 'background-color: #DC143C;' : '';
                                                                    $headerTextColor = $logbookData ? 'color: white;' : '';
                                                                @endphp
                                                                <div class="card mb-3" style="width: 600px;">
                                                                    <div class="card-header d-flex justify-content-between align-items-center toggle-card" style="{{ $headerBackground }} {{ $headerTextColor }}">
                                                                        <div>
                                                                            <b style="margin-right: 5px;">{{ \Carbon\Carbon::parse($l)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</b>
                                                                            <span class="badge"></span>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#detail-{{ $loop->index }}" style="color: black;">
                                                                                <i class="fas fa-caret-down"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="detail-{{ $loop->index }}" class="collapse card-body">
                                                                        <ul class="alignMe" style="list-style: none;">
                                                                            <li class="text-center">
                                                                                @if ($logbookData)
                                                                                    {{ $logbookData->kegiatan }}
                                                                                @else
                                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $loop->index }}">
                                                                                        +
                                                                                    </button>
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal Untuk Isi Logbook -->
                                                                <div class="modal fade" id="exampleModal-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">APA KEGIATANMU HARI INI ?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="POST" action="{{ route('logbook.store', ['id' => $user->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="id_pengajuan" value="{{ request()->query('id_pengajuan') }}">
                                                                                    <input type="hidden" name="tanggal" value="{{ $l }}">
                                                                                    <div class="form-group">
                                                                                        <label for="kegiatan">Deskripsikan Kegiatanmu:</label>
                                                                                        <textarea name="kegiatan" id="kegiatan" class="form-control" style="width: 750px; height: 250px"></textarea>
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

                                                            @endforeach
                                                        </div>
                                                    @endforeach
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
</div>
@endsection

@push('script')
<!-- JS Mengatur Card -->
<script>
    $(document).ready(function() {
        $('.toggle-card').click(function() {
            var cardBody = $(this).siblings('.card-body');
            cardBody.slideToggle();
        });
    });
</script>
@endpush
