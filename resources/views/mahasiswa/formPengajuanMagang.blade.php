@extends('mahasiswa.layouts.mainupload')

@section('content')
<div class="form-card">
    <h4 class="mt-0 mb-4 text-center">FORM PENGAJUAN MAGANG</h4>
    <div class="main">

        <div class="container">
            <form method="POST" id="pengajuan-form" class="pengajuan-form" enctype="multipart/form-data" action="{{ route('pengajuan.submit') }}">
                @csrf
                <h3>
                    Data Umum
                </h3>
                <fieldset>
                    <div class="form-group" style="width: 100%;">
                        <label for="name">Nama Lengkap:</label>
                        <input type="text" name="display_name" id="display_name" value="{{ $user->nama }}" disabled />
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai Magang:</label>
                            <input type="date" name="start_date" id="start_date" min="{{ date('Y-m-d') }}" class="form-control form-control-user @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" />
                            @error('start_date')
                            <div class="invalid-feedback" style="margin-top: -20px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai Magang:</label>
                            <input type="date" name="end_date" id="end_date" min="{{ date('Y-m-d') }}" class="form-control form-control-user @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" />
                            @error('end_date')
                            <div class="invalid-feedback" style="margin-top: -20px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-select">
                            <label for="databidang">Pilih Bidang Kerja</label>
                            <div class="select-group">
                                <select name="databidang_id" id="databidang" class="form-control form-control-user @error('databidang_id') is-invalid @enderror">
                                    <option value="" disabled selected hidden></option>
                                    @foreach ($databidang as $bidang)
                                    <option value="{{ $bidang->id }}">
                                        {{ $bidang->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('databidang_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="skill">Pilih Skill</label>
                            <div class="select-group">
                                <select name="skill[]" id="skill" multiple="multiple" class="form-control form-control-user @error('skill') is-invalid @enderror">
                                </select>
                                @error('skill')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h3>
                    Portofolio
                </h3>
                <fieldset>
                    <div class="form-row">
                        <div class="form-group" style="width: 100%;">
                            <label for="bukti">Bukti Project (pdf):</label>
                            <input type="file" name="bukti" id="bukti" class="form-control form-control-user @error('bukti') is-invalid @enderror" />
                            @error('bukti')
                            <div class="invalid-feedback" style="margin-top: -20px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form">
                        <label for="deskripsi">Deskripsi Project:</label>
                        <textarea id="deskripsi" name="deskripsi" style="resize: none; width: 100%; height:230px;" class="form-control form-control-user @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback" style="margin-top: -20px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </fieldset>

                <h3>
                    Upload Berkas
                </h3>
                <fieldset>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="proposal">Proposal
                                    Magang:</label>
                                <div class="upload-box" id="left-box">
                                    <p>Drag & Drop PDF</p>
                                    <br>
                                    <button type="button" class="btn btn-primary">Pilih
                                        File</button>
                                    <input type="file" id="proposal" name="proposal" accept=".pdf" style="display: none;" class="form-control form-control-user @error('proposal') is-invalid @enderror">
                                    @error('proposal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div id="proposal-info"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="pengantar">Surat Pengantar:</label>
                                <div class="upload-box" id="center-box">
                                    <p>Drag & Drop PDF</p>
                                    <br>
                                    <button type="button" class="btn btn-primary">Pilih
                                        File</button>
                                    <input type="file" id="pengantar" name="pengantar" accept=".pdf" style="display: none;" class="form-control form-control-user @error('pengantar') is-invalid @enderror">
                                    @error('pengantar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div id="pengantar-info"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="cv">Curicullum Vitae:</label>
                                <div class="upload-box" id="right-box">
                                    <p>Drag & Drop PDF</p>
                                    <br>
                                    <button type="button" class="btn btn-primary">Pilih
                                        File</button>
                                    <input type="file" id="cv" name="cv" accept=".pdf" style="display: none;" class="form-control form-control-user @error('cv') is-invalid @enderror">
                                    @error('cv')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div id="cv-info"></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>
@endsection
