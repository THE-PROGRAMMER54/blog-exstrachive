@extends("layouts.header")
@section("title")
<title>Dashboard</title>
@endsection
@section("content")
{{-- link css --}}
<link rel="stylesheet" href="css/home.css">
            <main class="main">
                @foreach ($blog as $blogs)
                    <div class="post-card">
                        <div class="post-header">
                            {{-- Tampilkan Foto Profil --}}
                            @if ($blogs->user->gambar && file_exists(public_path('storage/'.$blogs->user->gambar)))
                                <img src="{{ asset('storage/'.$blogs->user->gambar) }}" alt="Profile" class="profile-img">
                            @else
                                <img src="{{ asset('storage/profile.jpeg') }}" alt="Profile" class="profile-img">
                            @endif

                            <div class="post-info">
                                <h2 class="post-title">{{ $blogs->judul }}</h2>
                                <p class="post-meta">{{ $blogs->user->name }} | {{ $blogs->updated_at }}</p>
                            </div>
                        </div>
                        <p class="post-text">{{ $blogs->content }}</p>
                        <div class="post-footer">
                            <button class="comment-icon" data-id="{{ $blogs->id }}">
                                @if ($blogs->komentar->count() == 0)
                                    <i class="ph ph-chat-text"></i> Tidak ada komentar
                                @else
                                    <i class="ph ph-chat-text"></i> {{ $blogs->komentar->count() }} Komentar
                                @endif
                            </button>
                        </div>

                        <div class="comment-section" id="commentSection-{{ $blogs->id }}">
                            <h3>Komentar</h3>
                            @if (session("error"))
                                <div>{{ session("error") }}</div>
                            @endif

                            @if (Auth::check())
                                <form method="post" action="{{ route("komentarproses") }}" class="comment-form">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blogs->id }}">
                                    <textarea name="komentar" placeholder="Tulis komentar..." required></textarea>
                                    <button name="submit" type="submit">Kirim</button>
                                </form>
                            @endif

                            <!-- DAFTAR KOMENTAR -->
                            @foreach ($blogs->komentar as $komen)
                            <ul class="comment-list">
                                @if (Auth::check() && Auth::id() == $komen->user_id)
                                    <li>
                                        <div class="comment-content">
                                            <strong>{{ $komen->user->name }}</strong>
                                            <span class="comment-date">{{ $komen->created_at }}</span>
                                            <p>{{ $komen->komentar }}</p>
                                            <hr>
                                            <div class="btn-komentar">
                                                <button style="border: none; padding: 3px;" onclick="openeditkomen({{ $komen->id }})">
                                                    <i class="ph ph-pencil-simple-line"></i>
                                                </button>
                                                <form action="{{ route('deletekomen',$komen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    <button type="submit" style="border: none; padding: 3px;">
                                                        <i class="ph ph-trash"></i>
                                                    </button>
                                                </form>
                                                @if (session("error-komen"))
                                                    <script>
                                                        alert("{{ session("error-komen") }}");
                                                    </script>
                                                @endif

                                                @if (session("success-komen"))
                                                    <script>
                                                        alert("{{ session("success-komen") }}");
                                                    </script>
                                                @endif
                                                <div class="modal-overlay" id="modalOverlay"></div>

                                                <div class="edit-modal" id="editblog">
                                                    <div class="modal-content">
                                                        <h2>edit komen</h2>
                                                        <form action="{{ route('editkomen',$komen->id) }}" method="POST">
                                                            @csrf
                                                            <label for="komentar">Komentar</label>
                                                            <textarea name="komentar" required>{{ $komen->komentar }}</textarea>

                                                            <button type="submit">Kirim</button>
                                                            <button type="button" class="close-btn" onclick="closeeditkomen()">Batal</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                @else

                                    <li>
                                        <div class="comment-content">
                                            <strong>{{ $komen->user->name }}</strong>
                                            <span class="comment-date">{{ $komen->created_at }}</span>
                                            <p>{{ $komen->komentar }}</p>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </main>

        {{-- script js --}}
        <script src="js/home.js"></script>
        @endsection
