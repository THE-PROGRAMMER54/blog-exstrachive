<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Foto Profil</title>
    <link rel="stylesheet" href="css/fotoprofile.css">
</head>
<body>

<div class="profile-photo-section">
    <h2>Ubah Foto Profil</h2>

    <!-- Tampilan Foto yang Dipilih -->
    <div class="photo-wrapper">
        @if ($user->gambar == file_exists('storages/' . $user->gambar))
            <img id="preview-photo" src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil" class="profile-photo">
            @else
            <img id="preview-photo" src="storage/profile.jpeg" alt="Foto Profil" class="profile-photo">
        @endif
    </div>

    @if (session("error"))
        <div class="pesan-error">{{ session("error") }}</div>
    @endif

    <form id="upload-form" action="{{ route('uploadgambar') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Input untuk memilih foto -->
        <label for="photo-input" class="menu-item upload-btn">Pilih Foto</label>
        <input type="file" id="photo-input" name="gambar" accept="image/*" hidden>

        <!-- Tombol Unggah -->
        <button type="submit" class="menu-item submit-btn" id="upload-btn">Unggah</button>

    </form>
        <!-- Tombol Batal -->
        <a href="{{ route('settings') }}" class="menu-item cancel-btn">Batal</a>
</div>

<script>
    // Menampilkan gambar yang dipilih sebelum diunggah
    document.getElementById("photo-input").addEventListener("change", function(event) {
        const uploadBtn = document.getElementById("upload-btn");
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview-photo").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        if (file) {
            uploadBtn.style.display = "inline-block"; // Tampilkan tombol unggah
        } else {
            uploadBtn.style.display = "none"; // Sembunyikan tombol unggah jika tidak ada file dipilih
        }
    });
</script>

</body>
</html>
