<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function index()
    {
        $blog = blog::with("user","komentar.user")->get();
        return view('home', compact('blog'));
    }

    public function postingan_saya()
    {
        $blog = blog::where('user_id',Auth::id())->with("komentar.user")->get();
        return view('postingan_saya', compact('blog'));
    }

    public function tambahblog(Request $request){
        try{
            $request->validate([
                'judul' => 'required|max:25',
                'content' => 'required|string'
            ]);
            $blog = new blog();
            $blog->judul = $request->judul;
            $blog->content = $request->content;
            $blog->user_id = Auth::id();
            $blog->save();
            return redirect()->route("postingan-saya")->with("success-tambah","Berhasil menambahkan blog!!");
        }catch(Exception $e){
            return redirect()->back()->with("error-tambah","Gagal menambahkan blog,maksimal judul hanya 25 characters");
        }
    }

    public function editblog(Request $request,string $id){
        try{
            $blog = blog::findOrFail($id);
            $request->validate([
                'judul' =>'required|string|max:25',
                'content' =>'required',
            ]);
            $blog->judul = $request->judul;
            $blog->content = $request->content;
            $blog->save();
            return redirect()->back()->with('success', 'Postingan berhasil di edit!');
        }catch(Exception $e){
            return redirect()->back()->with("error","gagal mengedit blog!!");
        }
    }

    public function deleteblog(string $id){
        try{
            $blog = blog::findOrFail($id);
            $blog->delete();
            return redirect()->route("postingan-saya")->with('success-delete', 'Postingan berhasil dihapus!');
        }catch(Exception $e){
            return redirect()->back()->with('error-delete', 'Terjadi kesalahan, silahkan coba lagi!');
        }
    }
}
