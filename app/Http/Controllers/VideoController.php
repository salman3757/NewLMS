<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\Admin;
use App\Models\Course;

use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    //

    // Videos CRUD
    
    //Read
    public function show_videos($course_id=null){
        if( !$course_id){
            $course_id = Session::get('course_id');
            //Session::forget('course_id');
        }
        //$videos = Video::where('course_id', $course_id)->get();
        $course = Course::findOrFail($course_id);
        $videos = $course->videos;
        $comments = $course->comments;
        return view('admin.view_videos', ['course'=>$course, 'videos'=>$videos, 'comments'=>$comments]);
    }

    //Create
    public function create_video(Request $req){
        $video = new Video;

        $video->name = $req->name;
        $video->url = $req->url;
        $video->course_id = $req->course_id;

        $video->save();

        $course_id = $req->course_id;

        Session::put('course_id', $course_id);
        return redirect('show_videos');
        // return redirect('show_videos')->with(['course_id'=>$course_id]);
    }

    //Delete
    public function delete_video(Request $req){
        $video_id = $req->video_id;
        $video = Video::findOrFail($video_id);
        $video->delete();

        $course_id = $req->course_id;
        Session::put('course_id', $course_id);
        return redirect('show_videos');
    }

    //Show Edit Form
    public function show_video_edit_form($id){

        $video=Video::findOrFail($id);

        return view('admin.edit_video_view', ['video'=>$video]);
    }

    //Update
    public function update_video(Request $req){
        //Get Video id value from hidden field in form 
        $video_id = $req->video_id;
        //Find Video usinf video id
        $video = Video::findOrFail($video_id);
        //Update Values
        $video->name = $req->name;
        $video->url = $req->url;
        //Save
        $video->save();
        //Redirect (with course_id to load/show videos of that course)
        // Either use Sessions OR pass course_id in redirect URL.
        $course_id=$req->course_id;
        Session::put('course_id', $course_id);
        return redirect("show_videos/$course_id");
    }

}
