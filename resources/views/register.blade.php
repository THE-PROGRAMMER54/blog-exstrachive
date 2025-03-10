<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">


        <div class="login-container">
            <h2>Register</h2>
            <form action="{{ route("processRegist") }}" method="POST">
                @csrf
                @if (session("error"))
                    <div class="pesan-error">{{ session("error") }}</div>
                @endif
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required autocomplete="off">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autocomplete="off">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="off">
                </div>
                <button type="submit" class="login-btn">Daftar</button>
                <p style="font-size: 14px; color: #666; margin-top: 10px;">
                    Apakah kamu sudah memiliki akun?
                    <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Login di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
