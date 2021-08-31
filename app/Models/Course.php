<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Video;
use App\Models\Client;
use App\Models\Comment;

class Course extends Model
{

    use HasFactory;

    public $timestamps = false;
    public function videos(){
        return $this->hasMany(Video::class, 'course_id');
    }

    public function clients(){
        return $this->belongsToMany(Client::class, 'course_client');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'course_id');
    }
}
