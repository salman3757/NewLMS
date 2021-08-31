<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Video;

use App\Http\Resources\CourseResource;

class CourseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CourseResource::collection(Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $course = new Course;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->admin_id = $request->admin_id;
        $course->save();

        // Create a New Instance of CourseResource Class which returns the passed as parameter 
        // Object's name, description
        // and admin_id. As was Desfined in the toArray Method of the Class
        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new CourseResource(Course::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $course = Course::findOrFail($id);
        $result = $course->delete();
        return $result;
    }



    /**
     * 
     * CRUD (Resource) Section  ENDS  Here
     * 
     */


     /**
      * Other functions section start
      */

      //get Videos of One Course
      public function get_course_videos($id){
          $course = Course::findOrFail($id);
          $videos = $course->videos;
          return $videos;
      }
      //Get Comments of One Course
      public function get_course_comments($id){
          $course = Course::findOrFail($id);
          $comments = $course->comments;
          return $comments; 
      }

      //Add and Assign video to Course
      public function add_assign_video(Request $request){
          $video = new Video;
          $video->name = $request->name;
          $video->url=$request->url;
          $video->course_id = $request->course_id;
          $video->save();

          return $video;
      }

      //Delete Video
      public function delete_video($id){
          $video = Video::findOrFail($id);
          $result = $video->delete();

          return $result;
      }

      //Show the Video Data, To Edit Video
      public function edit_video($id){
        $video = Video::findOrFail($id);
        return $video;
    }

      //Update Video
      public function update_video(Request $request, $id){
         // $video = Video::where('id',$id)->get();  // IT Caused Error, because get() method will get More Than One Results, 
         // and save() method does Not work for arraty of object. So USE first() insted of get()
          $video = Video::where('id',$id)->first();
          $video->name = $request->name;
          $video->url = $request->url;
          $video->save();

          return $video;
      }
      
}
