@extends('layouts.header')

@section("title")
    <title>Profile</title>
@endsection

@section("content")
    <link rel="stylesheet" href="css/profile.css">
    <div class="container">
        <h1>Profile</h1>
        <div class="profile-photo-section">
            @if (session("success"))
                <div class="pesan-success">{{ session("success") }}</div>
            @endif
            <div class="photo-wrapper">
                @if ($user->gambar == file_exists('storage/' . $user->gambar))
                    <img id="profile-photo" src="{{ asset('storage/' . $user->gambar) }}" alt="Profile Photo" class="profile-photo">
                    @else
                    <img id="profile-photo" src="storage/profile.jpeg" alt="Profile Photo" class="profile-photo">
                @endif
                <i class="ph ph-camera photo-icon" id="open-menu"></i>
            </div>
            <div class="menu-popup" id="photo-menu">
                <a class="menu-item" href="{{ route('fotoProfile') }}">Ganti Foto</a>
                @if ($user->gambar !== "profile.jpeg")
                <form action="{{ route("deleteprofile",$user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="menu-item" id="delete-photo">Hapus Foto</button>
                </form>
                @endif
            </div>

            @if (session("success-gambar"))
                <script>
                    alert("{{ session("success-gambar") }}")
                </script>
            @endif
            @if (session("error-gambar"))
                <script>
                    alert("{{ session("error-gambar") }}")
                </script>
            @endif

        </div>
        <div class="card full-width">
            <h2>Profile Information</h2>
            <p>Update your account's profile information and email address.</p>

            @if (session("error-userEmail"))
                <div class="pesan-error">{{ session("error-userEmail") }}</div>
            @endif

            @if (session("success-userEmail"))
                <div class="pesan-success">{{ session("success-userEmail") }}</div>
            @endif

            <form action="{{ route("edituser") }}" method="post">
                @csrf
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="{{ $user->name }}" value="{{ $user->name }}">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="{{ $user->email }}" value="{{ $user->email }}">

                <button type="submit" class="save-btn">Save</button>
            </form>
        </div>
        <div class="card full-width">
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>

            @if (session("error-pass"))
                <div class="pesan-error">{{ session("error-pass") }}</div>
            @endif

            @if (session("success-pass"))
                <div class="pesan-success">{{ session("success-pass") }}</div>
            @endif

            <form action="{{ route("editpass") }}" method="post">
                @csrf
                <label for="current-password">Current Password</label>
                <input type="password" name="oldpass" id="current-password">

                <label for="new-password">New Password</label>
                <input type="password" name="newpass" id="new-password">

                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirmpass" id="confirm-password">

                <button type="submit" class="save-btn">Save</button>
            </form>
        </div>
        <div class="card full-width">
            @if (session("error"))
                <div class="pesan-error">{{ session("error") }}</div>
            @endif
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            <form action="{{ route('deleteakun') }}" method="post" onsubmit="return confirm('Yakin ingin menghapus akun??')">
                @csrf
                <button class="delete-btn">Delete Account</button>
            </form>
        </div>
    </div>
@endsection

{{-- script untuk btn dropdown image --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const menu = document.getElementById("photo-menu");
    const openMenu = document.getElementById("open-menu");

    if (menu && openMenu) {
        // Toggle menu saat ikon diklik
        openMenu.addEventListener("click", function (event) {
            event.stopPropagation(); // Mencegah event klik menyebar ke document
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        });

        // Agar menu tetap bisa diklik tanpa langsung tertutup
        menu.addEventListener("click", function (event) {
            event.stopPropagation();
        });

        // Sembunyikan menu jika klik di luar
        document.addEventListener("click", function () {
            menu.style.display = "none";
        });
    }
});

</script>
{{-- script phosphor-icons --}}
<script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
