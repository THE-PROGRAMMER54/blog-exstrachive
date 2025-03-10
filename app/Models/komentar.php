<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $table = 'komentar';
    protected $guarded = [];
    protected $hidden = [];

    public function blog(){
        return $this->belongsTo(blog::class, 'blogs_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
