<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Mari Magang</title>

    <!-- File CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">

    <!-- File CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/alert.css') }}">

</head>

<body>
    @if (session()->has('loginError'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('loginError') }}',
            footer: '{{ session('loginErrorDetails') }}'
        });
    </script>
    {{-- <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('loginError') }}
        <br>
        {{ session('loginErrorDetails') }}
    </div> --}}
    @endif

    <!-- Body -->
    @yield('content')

    <script src="{{ asset('assets/js/form.js') }}"></script>

</body>

</html>
