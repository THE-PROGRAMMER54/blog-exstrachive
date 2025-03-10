<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
            <p>silahkan login terlebih dahulu!!</p>
            <form action="{{ route("processLogin") }}" method="POST">
                @csrf

                @if (session("error"))
                    <div class="pesan-error">{{ session("error") }}</div>
                @endif

                @if (session("success"))
                    <div class="pesan-succes">{{ session("succes") }}</div>
                @endif

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Masuk</button>
                <p style="font-size: 14px; color: #666; margin-top: 10px;">
                    Apakah kamu belum memiliki akun?
                    <a href="{{ route('register') }}" style="color: #007bff; text-decoration: none;">Daftar di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
