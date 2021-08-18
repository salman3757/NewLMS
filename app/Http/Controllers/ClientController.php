<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Client;
use App\Models\Course;

class ClientController extends Controller
{
    
    /**
     * Login / Logout
     */

    // Show Login Form
    public function show_login_form(){
        return view('client.client_login');
    }

    //Client Login Process
    public function login(Request $req){
        $email=$req->email; //Email Received from form
        $password=$req->password; //Email Received from form

        $client=Client::where('email', $email)->first();
        if($client){
            $password_check=Hash::check($password, $client->password);
        }
        if(!$client || !$password_check){
            return "Email or Password Incorrect";
        }
        else{
            Session::put('client',$client);
            return redirect('client_home');
        }
    }

    //Client Logout Process
    public function logout(){
        Session::forget('client');
        return redirect('/');
    }

    //Login Successful
    public function show_client_home(){
        $client = Session::get('client');
        $courses = $client->courses;
        return view('client.client_home', ['client'=>$client, 'courses'=>$courses]);
    }

    //Show Course Details, Videos and Comments To Client
    public function show_course($course_id){
        $course = Course::findOrFail($course_id);
        $videos = $course->videos;

        $comments = $course->comments;
        return view('client.show_course_client', ['course'=>$course, 'videos'=>$videos, 'comments'=>$comments]);
    }


    /***
     * 
     * ADMIN SIDE FUNCTIONS ON CLIENT
     *
     */
    // Show Client's Courses To ADMIN and Add course Form
    public function client_courses($id=null){

        if($id === null ):
            //Testing Phase
            $client=Session::get('client');
        else:
            $client = Client::findOrFail($id);
            //Session::forget('client');
            Session::put('client',$client);
        endif;

        $courses=$client->courses;

        

        return view('client.client_courses', ['courses'=>$courses]);
    }

    //Admin Search Courses on Client page to assign course to client
    public function search_client_courses(Request $req){
        $searched_courses = Course::where('name', 'Like', '%'.$req->search.'%')
                   ->orWhere('description', 'LIKE', '%'.$req->search.'%')
                   ->get();
        
        //Courses previously assigned to Client, passed as array in hidden field in form
        //Since the search results will be displayed on the same page so previously assigned 
        //courses data must be kept
        //$assigned_courses = $req->client_courses;
        $assigned_courses = Session::get('client')->courses;
        
        return view('client.client_courses', ['searched_courses'=>$searched_courses, 'courses'=>$assigned_courses]);
    }

    //Assign Course to Client
    public function assign_course(Request $req){
        $client = Session::get('client');
        $course_id = $req->course_id;
        $client->courses()->attach($course_id);


        return redirect('client_courses/'.$client->id);
    }
    
    //De-Assign Course from CLient
    public function de_assign_course(Request $req){
        $course_id = $req->course_id;
        $client=Session::get('client');

        $client->courses()->detach($course_id);
        
        return redirect('client_courses/'.$client->id);
    }
}
