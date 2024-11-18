<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
<img class="wave" src="{{ asset('img/wave.png') }}">
<div class="container">
    <div class="img">
        <img src="{{ asset('img/educator.svg') }}">
    </div>
    <div class="login-container">
        <form method="POST" action="{{ route('login') }}" class="login">
            @csrf

            <img class="avatar" src="{{ asset('img/login.svg') }}">
            <h2>Welcome</h2>

            @if($errors->any())
                <div class="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if(session('status'))
                <div class="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="input-div one">
                <div class="i">
                    <i class='bx bxs-user'></i>
                </div>
                <div>
                    <h5>Username</h5>
                    <input
                        type="text"
                        class="input @error('name') is-invalid @enderror"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="username"
                        autofocus
                    >
                </div>
            </div>

            <div class="input-div two">
                <div class="i">
                    <i class='bx bxs-lock'></i>
                </div>
                <div>
                    <h5>Password</h5>
                    <input
                        type="password"
                        class="input @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                </div>
            </div>

            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif

            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</div>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
