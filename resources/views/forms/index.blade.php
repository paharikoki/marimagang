@extends('forms.layouts.main')

@section('content')
<div class="container" id="container">
    <div class="form-container sign-up-container" id="registerForm">

        <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" id="register-form" style="margin-top: 20px">
            @csrf
            <h1>Daftar</h1>
            <div class="form-group">
                <label class="form-label" for="nim">NIM</label>
                <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}" required>
                @error('nim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <br>
            <button type="submit">Daftar</button>
            <p id="back"><a href="/">Kembali ke halaman awal</a></p>
        </form>

    </div>

    <div class="form-container sign-in-container">



        <form method="POST" action="{{ route('login.submit') }}" id="login-form" class="signup-form" enctype="multipart/form-data">
            @csrf

            <h1>Masuk</h1>



            <div class="form-group">
                <label class="form-label" for="emaillogin">Email</label>
                <input type="email" class="form-control form-control-user @error('emaillogin') is-invalid @enderror" id="emaillogin" name="emaillogin" placeholder="Email" value="{{ old('emaillogin') }}" required>
                @error('emaillogin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="passwordlogin">Password</label>
                <input type="password" class="form-control form-control-user @error('passwordlogin') is-invalid @enderror" id="passwordlogin" name="passwordlogin" placeholder="Password" required>
                @error('passwordlogin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <br>
            <button type="submit">Masuk</button>
            <p id="back"><a href="/">Kembali ke halaman awal</a></p>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Silahkan Login</h1>
                <p>Klik tombol dibawah ini untuk masuk pada website </p>
                <button class="ghost" id="signIn">Masuk</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Silahkan Register</h1>
                <p>Klik tombol dibawah ini untuk melakukan pembuatan akun anda</p>
                <button class="ghost" id="signUp">Daftar</button>
            </div>
        </div>
    </div>
</div>
@endsection
