<?php

namespace App\Http\Controllers;

use App\Models\komentar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class komenController extends Controller
{
    public function komentarproses(Request $request)
    {
        try{
            $request->validate([
                "komentar" => "required|string",
                "blog_id" => "required|integer",
            ]);

            $komentar = new komentar;
            $komentar->user_id = Auth::id();
            $komentar->blog_id = $request->blog_id;
            $komentar->komentar = $request->komentar;
            $komentar->save();

            return redirect()->back()->with(["succes" => "Komentar berhasil ditambahkan"]);
        }catch(Exception $e){
            return redirect()->back()->with(["error" => "komentar gagal silahkan tambahkan komentar lagi!!," . $e->getMessage()]);
        }
    }

    public function editKomen(Request $request,string $id){
        try{
            $request->validate([
                "komentar" => "required|string",
            ]);
            $komentar = komentar::findOrFail($id);
            if($komentar->user_id == Auth::id()){
                $komentar->komentar = $request->komentar;
                $komentar->save();
                return redirect()->back()->with(["success-komen" => "Komentar berhasil diedit"]);
                }else{
                return redirect()->back()->with(["error-komen" => "Anda bukan pemilik komentar ini!!"]);
            }
        }catch(Exception $e){
            return redirect()->back()->with(["error-komen" => "Komentar gagal diedit silahkan edit komentar lagi!!"]);
        }
    }

    public function deleteKomen(string $id){
        try{
            $komentar = komentar::findOrFail($id);
            if($komentar->user_id == Auth::id()){
                $komentar->delete();
                return redirect()->route("dashboard")->with(["success-komen" => "Komentar berhasil dihapus"]);
                } else{
                return redirect()->back()->with(["error-komen" => "Anda bukan pemilik komentar ini!!"]);
            }
        }catch(Exception $e){
            return redirect()->back()->with(["error-komen" => "Komentar gagal dihapus silahkan hapus komentar lagi!!"]);
        }
    }
}
