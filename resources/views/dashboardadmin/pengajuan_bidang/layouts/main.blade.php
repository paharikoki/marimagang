<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard Bidang</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/images/admin/icon.ico" type="image/x-icon" />

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

    <link rel="stylesheet" href="{{ asset('assets/css/admin/detail.css') }}">

    <style>
        .tgl-row {
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        .tgl-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tgl-date {
            margin: 10px;
        }

        .tgl-content {
            padding: 10px 10px;
        }

        .isi-logbook {
            margin-bottom: 10px;
        }

        .tgl-header i.fas.fa-chevron-down {
            margin-right: 15px;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        @include('dashboardbidang.layouts.header')

        <!-- Sidebar -->
        @include('dashboardbidang.layouts.sidebar')

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

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/admin/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/admin/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

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

    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: 60,
            maxValue: 100,
            width: 7,
            text: 5,
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: 70,
            maxValue: 100,
            width: 7,
            text: 36,
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 40,
            maxValue: 100,
            width: 7,
            text: 12,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                datasets: [{
                    label: "Total Income",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }]
                },
            }
        });

        $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>

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
        var SweetAlert2Demo = function() {

            var initDemos = function() {

                $('.delete-button-admin').click(function(e) {
                    e.preventDefault();

                    var deleteUrl = $(this).attr('href');

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

                $('.block-button-mahasiswa').click(function(e) {
                    e.preventDefault();

                    var deleteUrl = $(this).attr('href');

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

    <script>
        function activateTab(tabID) {
            var tabLinks = document.querySelectorAll('.nav-tabs .nav-item');
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove('active');
            }

            document.querySelector('a[href="#' + tabID + '"]').parentNode.classList.add('active');

            var tabContent = document.querySelectorAll('.tab-pane');
            for (var i = 0; i < tabContent.length; i++) {
                tabContent[i].classList.remove('active');
            }
            document.getElementById(tabID).classList.add('active');
        }
    </script>
    @stack('script')
</body>

</html>