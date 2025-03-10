<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class usersController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function processLogin(Request $request)
    {
        try{
            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required|min:8',
                ]
            );

            if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
                $request->session()->regenerate();
                return redirect()->route('home')->with(["success" => "berhasil login"]);
            }else{
                return redirect()->back()->with(["error" => "Email atau password anda salah"]);
             }
        }catch(Exception $e){
            return redirect()->back()->with(["error" => "Email belum terdaftar!!"]);
        }
    }


    public function register()
    {
        return view('register');
    }


    public function processRegist(Request $request)
    {
        try{
            $request->validate([
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            $users = new User();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password =  bcrypt($request->password);
            $users->save();

            return redirect()->route('login')->with(['success' => 'Pendaftaran berhasil! Silahkan login']);
        }catch(Exception $e){
            return redirect()->back()->with(['error' => "email,name,password anda tidak valid"]);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('dashboard')->with(['success' => 'Berhasil logout']);
    }
    public function setting(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }


    public function edituser(Request $request)
    {
        try{
            $user = User::findOrFail(Auth::id());
            $request->validate([
                "name" => "string|max:255",
                "email" => "email|max:255|unique:users,email," . $user->id,
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->back()->with("success-userEmail","Berhasil merubah username dan email anda");
        }catch(Exception $e){
            return redirect()->back()->with("error-userEmail,",$e->getMessage());
        }
    }


    public function editpass(Request $request)
    {
        try{
            $user = User::findOrFail(Auth::id());
            $request->validate([
                "oldpass" => "string|min:8",
                "newpass" => "string|min:8",
                "confirmpass" => "string|min:8|same:newpass",
            ]);

            if(!Hash::check($request->oldpass,$user->password)){
                return redirect()->back()->with("error-pass","Kata sandi lama anda salah,silahkan masukan sandi anda sebelumnya!!");
            }

            $user->password = bcrypt($request->newpass);
            $user->save();

            return redirect()->back()->with("success","Kata sandi anda berhasil di ganti");
        }catch(Exception $e){
            return redirect()->back()->with("error-pass","Masukan minimum 8 characters untuk mengganti sandi anda sebelumnya");
        }
    }


    public function deleteakun()
    {
        try{
            $user = User::findOrFail(Auth::id());

            $path = public_path("storage/" . $user->gambar);
            if($user->gambar != "profile.jpeg" && $user->gambar == file_exists($path)){
                unlink($path);
            }

            $user->delete();
            Auth::logout();
            return redirect()->route('login')->with("success", "Akun anda berhasil dihapus");
        }catch(Exception $e){
            return redirect()->back()->with("error","Terjadi kesalahan saat menghapus akun anda");
        }
    }
}
