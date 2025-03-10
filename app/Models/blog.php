<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blog';
    protected $guarded = [];
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function komentar(){
        return $this->hasMany(komentar::class, 'blog_id', 'id');
    }
}
