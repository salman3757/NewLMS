<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Comment;
use App\Models\Course;

class CommentController extends Controller
{
    //Create Comment
    public function create_comment(Request $req){

        $course_id = $req->course_id;
        $client = Session::get('client');
        $client_name = $client['name'];

        $comment = new Comment;
        $comment->comment_text = $req->comment_text;
        $comment->client_name = $client_name;
        $comment->course_id = $course_id;
        $comment->save();

        return redirect("show_course_client/$course_id"); 

        //Inserted Course id in Redirect URL String
        //using variable substitution, in double quotes string.
    }
}
