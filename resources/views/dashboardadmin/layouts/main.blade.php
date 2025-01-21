<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard Admin</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/admin/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        var customFontsUrl = '{{ asset("assets/css/fonts.min.css") }}';

        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: [customFontsUrl]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/atlantis.min.css') }}">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        @include('dashboardadmin.layouts.header')

        <!-- Sidebar -->
        @include('dashboardadmin.layouts.sidebar')

        <!-- Body -->
        @include('sweetalert::alert')
        @yield('content')

    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/admin/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/admin/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/admin/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/admin/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/admin/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/admin/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/admin/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/admin/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('assets/js/admin/atlantis.min.js') }}"></script>

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});

            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.bidang').click(function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');
                swal({
                    title: 'Apakah Kamu Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, Batalkan!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, Hapus Data!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = deleteUrl;
                    }
                });
            });

            $('.close-button-bidang').click(function(e) {
                e.preventDefault();
                var blockUrl = $(this).attr('href');
                swal({
                    title: 'Apakah kamu yakin?',
                    text: "Bidang Yang Ditutup Tidak Dapat Diambil Oleh Mahasiswa",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, Batalkan!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, Tutup Bidang!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = blockUrl;
                    }
                });
            });

        });
    </script>

    <script>
        function previewThumbnail() {
            var thumbnailInput = document.getElementById('thumbnail');
            var thumbnailPreview = document.getElementById('thumbnail-preview');

            thumbnailInput.addEventListener('change', function() {
                var file = thumbnailInput.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            });
        }

        function previewPhoto() {
            var photoInput = document.getElementById('photo');
            var photoPreview = document.getElementById('photo-preview');

            photoInput.addEventListener('change', function() {
                var file = photoInput.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            });
        }

        window.addEventListener('load', function() {
            previewThumbnail();
            previewPhoto();
        });
    </script>

    <script type="text/javascript">
        $('.addmulti').on('click', function() {
            addmulti();
        });

        function addmulti() {
            var multi = '<div class="form-group row"><label class="col-sm-3 col-form-label">Skill</label><div class="col-sm-8"><input type="text" class="form-control @error('
            skill ') is-invalid @enderror" name="skill[]" id="skill" placeholder="Skill Yang Dibutuhkan" value="{{ is_array(old('
            skill ')) ? old('
            skill ')[0] : old('
            skill ') }}" />@error('
            skill ')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="col-sm-1"><a href="#" class="remove btn btn-danger plus float-right">-</a></div></div>';
            $('.multi').append(multi);
        };

        $(document).on('click', '.remove', function() {
            $(this).parent().parent().remove();
        });
    </script>

    <script>
        var SweetAlert2Demo = function() {

            var initDemos = function() {

                $('.bidang-delete').submit(function(e) {
                    e.preventDefault();

                    var deleteUrl = $(this).attr('action');

                    swal({
                        title: 'Apakah Kamu Yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan",
                        type: 'warning',
                        buttons: {
                            cancel: {
                                visible: true,
                                text: 'Tidak, batalkan!',
                                className: 'btn btn-danger'
                            },
                            confirm: {
                                text: 'Ya, hapus data!',
                                className: 'btn btn-success'
                            }
                        }
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = deleteUrl;
                        }
                    });
                });
            };

            return {
                init: function() {
                    initDemos();
                },
            };
        }();

        jQuery(document).ready(function() {
            SweetAlert2Demo.init();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-button-admin').click(function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');
                swal({
                    title: 'Apakah kamu yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, batalkan!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, hapus data!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = deleteUrl;
                    }
                });
            });

            $('.block-button-mahasiswa').click(function(e) {
                e.preventDefault();
                var blockUrl = $(this).attr('href');
                swal({
                    title: 'Apakah kamu yakin?',
                    text: "Mahasiswa yang diblokir tidak akan dapat mengakses lagi",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, batalkan!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, blokir akun!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = blockUrl;
                    }
                });
            });

        });
    </script>
    @stack('script')
</body>

</html>