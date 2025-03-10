<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class gambarController extends Controller
{

    public function fotoProfile()
    {
        $user = User::findOrFail(Auth::id());
        return view('fotoprofile', compact('user'));
    }
    public function uploadgambar(Request $request)
{
    try {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = public_path('storage/' . $user->gambar);
        if ($user->gambar != "profile.jpeg" && file_exists($path)) {
            unlink($path);
        }

        $gambar = $request->file('gambar');
        $nama_gambar = time() . "_" . $gambar->getClientOriginalName();
        $gambar->move(public_path('storage'), $nama_gambar);
        $user->gambar = $nama_gambar;
        $user->save();

        return redirect()->route("settings")->with("success", "Foto profile berhasil diganti!");
    } catch (Exception $e) {
        return redirect()->back()->with("error", "Terjadi kesalahan saat mengupload gambar.");
    }
}

    public function deleteprofile(string $id){
        try{
            $user = User::findOrFail($id);
            $path = public_path('storage/'. $user->gambar);
            if($user->gambar!= "profile.jpeg" && file_exists($path)){
                unlink($path);
            }
            $user->gambar = "profile.jpeg";
            $user->save();
            return redirect()->route("settings")->with('success-gambar', 'Foto profile berhasil dihapus!');
        }catch(Exception $e){
            return redirect()->back()->with('error-gambar', 'Terjadi kesalahan, silahkan coba lagi!'.$e->getMessage());
        }
    }
}
