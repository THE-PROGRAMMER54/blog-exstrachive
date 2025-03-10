<?php

use App\Http\Controllers\blogController;
use App\Http\Controllers\gambarController;
use App\Http\Controllers\komenController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function(){

    //guest
    Route::get('/login', [usersController::class, "login"])->name('login');
    Route::post('/proseslogin', [usersController::class, "processLogin"])->name('processLogin');
    Route::get('/register',[usersController::class, "register"])->name('register');
    Route::post('/register',[usersController::class, "processRegist"])->name('processRegist');

});

    //dashboard
    Route::get('/', [blogController::class, "index"])->name('dashboard');

Route::middleware("auth")->group(function(){

    // user
    Route::get('/settings', [usersController::class, "setting"])->name('settings');
    Route::post('/logout', [usersController::class, "logout"])->name('logout');
    Route::post("/edituser",[usersController::class,"edituser"])->name("edituser");
    Route::post("/editpass",[usersController::class, "editpass"])->name("editpass");
    Route::post('/deleteaccount',[usersController::class, "deleteakun"])->name("deleteakun");


    // blog
    Route::get('/postingan-saya',[blogController::class, "postingan_saya"])->name('postingan-saya');
    Route::post('/tambahblog',[blogController::class, "tambahblog"])->name('tambahblog');
    Route::post('/editblog/{id}',[blogController::class, 'editblog'])->name('editblog');
    Route::post('/deleteblog/{id}',[blogController::class, "deleteblog"])->name('deleteblog');


    // komentar
    Route::post('/komentar',[komenController::class, "komentarproses"])->name("komentarproses");
    Route::post('/editkomen/{id}',[komenController::class, "editkomen"])->name("editkomen");;
    Route::post('/deletekomen/{id}',[komenController::class, "deletekomen"])->name("deletekomen");

    // gambar
    Route::get('/fotoProfile',[gambarController::class, "fotoProfile"])->name("fotoProfile");
    Route::post('/uploadgambar',[gambarController::class, "uploadgambar"])->name("uploadgambar");
    Route::post('/deleteprofile/{id}',[gambarController::class, "deleteprofile"])->name("deleteprofile");
});
