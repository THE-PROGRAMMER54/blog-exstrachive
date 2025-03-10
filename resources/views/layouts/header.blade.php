<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield("title")
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <div class="container">
        {{-- navbar --}}
        <header class="header">
            <img src="gambar/logos.png" alt="logo Extrachive" class="img-logo">
            @yield("btn-khusus")
            <div class="dropdown">
                <button class="dropdown-btn">
                    <i class="ph ph-list"></i>
                </button>
                <div class="dropdown-content">
                    <a href="{{ route("dashboard") }}">Dashboard</a>
                    <a href="{{ route("settings") }}">Setting</a>
                    <a href="{{ route("postingan-saya") }}">Postingan saya</a>
                    @if (Auth::check())
                        <form method="post" action="{{ route("logout") }}" onsubmit="return confirm('apakah kamu ingin logout??')">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="loginbtn">Login</a>
                    @endif
                </div>
            </div>
        </header>
        <main>
            @yield("content")
        </main>
    </div>
</body>
</html>

{{-- icon --}}
<script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
