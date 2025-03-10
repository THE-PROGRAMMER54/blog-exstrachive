@extends("layouts.header")

@section('title')
    <title>Postingan saya</title>
@endsection

@section("btn-khusus")
    <button class="btn-tambah" onclick="opentambahblog()">Tambahkan Blog Anda</button>
    @if (session("error-tambah"))
        <script>
            let errorMessage = {!! json_encode(session("error-tambah")) !!};
            alert(errorMessage);
        </script>
    @endif

    @if (session("success-tambah"))
        <script>
            alert("{{ session("success-tambah") }}");
        </script>
    @endif
    <div class="modal-overlay" id="modalOverlay"></div>

    <div class="edit-modal" id="tambahblog">
        <div class="modal-content">
            <h2>Tambah Blog</h2>
            <form action="{{ route('tambahblog') }}" method="POST">
                @csrf
                <label for="judul">Judul</label>
                <input type="text" name="judul" required>

                <label for="content">Blog</label>
                <textarea name="content" required></textarea>

                <button type="submit">Kirim</button>
                <button type="button" class="close-btn" onclick="closetambahblog()">Batal</button>
            </form>
        </div>
    </div>
@endsection

@section("content")
{{-- link css --}}
<link rel="stylesheet" href="css/posting-saya.css">

            <main class="main">
                @if ($blog->count() === 0)
                <h1 class="blog-kosong">tidak ada blog</h1>
                @else
                @foreach ($blog as $blogs)
                    <div class="post-card">
                        <div class="post-header">
                            <div class="header1">
                                @if ($blogs->user->gambar && file_exists(public_path('storage/'.$blogs->user->gambar)))
                                <img src="{{ asset('storage/'.$blogs->user->gambar) }}" alt="Profile" class="profile-img">
                                @else
                                @endif
                                <div class="post-info">
                                    <h2 class="post-title">{{ $blogs->judul }}</h2>
                                    <p class="post-meta">{{ $blogs->user->name }} | {{ $blogs->updated_at }}</p>
                                </div>
                            </div>
                            <div class="header2">
                                <i class="ph ph-dots-three-outline" onclick="toggleDropdown({{ $blogs->id }})"></i>
                                <div class="dropdown-menu" id="dropdown-{{ $blogs->id }}">
                                    <button class="a-editheader" onclick="openeditblog({{ $blogs->id }})">
                                        <i class="ph ph-pencil-simple-line"></i>
                                    </button>
                                    <form action="{{ route('deleteblog',$blogs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        <button type="submit">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="post-text">{{ $blogs->content }}</p>
                        <div class="post-footer">

                            @if (session("success"))
                            <div class="pesan-success">{{ session("success") }}</div>
                            @endif
                            @if (session("error"))
                            <div class="pesan-error">{{ session("error") }}</div>
                            @endif
                            <button class="comment-icon" data-id="{{ $blogs->id }}">
                                @if ($blogs->komentar->count() == 0)
                                    <i class="ph ph-chat-text"></i> Tidak ada komentar
                                @else
                                    <i class="ph ph-chat-text"></i> {{ $blogs->komentar->count() }} Komentar
                                @endif
                            </button>
                        </div>

                        <div class="comment-section" id="commentSection-{{ $blogs->id }}">
                            <!-- DAFTAR KOMENTAR -->
                            @foreach ($blogs->komentar as $komen)
                            <ul class="comment-list">
                                <li>
                                    <div class="comment-content">
                                        <strong>{{ $komen->user->name }}</strong>
                                        <span class="comment-date">{{ $komen->created_at }}</span>
                                        <p>{{ $komen->komentar }}</p>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>

                    @if (session("success-delete"))
                        <script>
                            alert("{{ session("success-delete") }}")
                        </script>
                    @endif
                    @if (session("error-delete"))
                        <script>
                            let errorMessage = {!! json_encode(session("error-delete")) !!};
                            alert(errorMessage);
                        </script>
                    @endif

                    <div class="modal-overlay" id="modalOverlay"></div>
                    <div class="edit-modal" id="editModal-{{ $blogs->id }}">
                        <div class="modal-content">
                            <h2>Edit Blog</h2>
                            <form action="{{ route('editblog',$blogs->id) }}" method="POST">
                                @csrf
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" value="{{ $blogs->judul }}" required>

                                <label for="content">Blog</label>
                                <textarea name="content" required>{{ $blogs->content }}</textarea>

                                <button type="submit">Simpan</button>
                                <button type="button" class="close-btn" onclick="closeeditblog()">Batal</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @endif
            </main>
            {{-- script js --}}
            <script src="js/posting.js"></script>

            @endsection
