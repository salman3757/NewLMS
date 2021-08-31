<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\password_reset;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Client;
use App\Models\Video;

class AdminController extends Controller
{


    //Registration
    public function show_registration_form(){
        return view('admin.admin_register');
    }

    public function register(Request $req){
        $admin=new Admin;
        $admin->name=$req->name;
        $admin->email=$req->email;
        $admin->password=Hash::make($req->password);

        $admin->save();
        Session::put('admin', $admin);
        return redirect('admin_panel');
    }


    // Login
    //show login form
    public function show_login_form(){
        return view('admin.admin_login');
    }

    //login process
    public function login(Request $req){

        $email=$req->email;
        $password=$req->password; 

        $admin=Admin::where('email',$email)->first();
        if($admin){
            $password_check=Hash::check($password, $admin->password);
        }
        if(!$admin || !$password_check){
            return "Username or Password Incorrect";
        }
        
        else{
            Session::put('admin', $admin);
            return redirect('admin_panel');
        }
    }

    //Logout
    public function logout(){
        Session::forget('admin');
        return redirect('/');
    }
    //Show Admin Panel
    public function show_admin_panel(){
        return view('admin.admin_panel');
    }




    /**
     * Courses CRUD Functions
     */

     //Read
     public function show_courses(){
         $courses = Course::all();
         return view('admin.view_courses', ['courses'=>$courses]);
     }

     //Create
    public function create_course(Request $req){
        $admin_id=$req->admin_id;
        $course_name=$req->name;
        $course_description=$req->description;

        $course=new Course;
        $course->name=$course_name;
        $course->description=$course_description;
        $course->admin_id=$admin_id;
        $course->save();

        return view('admin.admin_panel', ['NewCourse'=>$course]);
    }

    //Show Edit Form
    public function show_course_edit_form($id){
        $course=Course::findOrFail($id);

        return view('admin.edit_course_view', ['course'=>$course]);
    } 

    // Update Course Data
    public function update_course(Request $req){
        $id = $req->id;
        $course = Course::findOrFail($id);
        $course->name = $req->name;
        $course->description = $req->description;
        $course->save();

        return redirect('show_courses');
    }

    //Delete Course
    public function delete_course($id){
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect('show_courses');
    }
    /**
     * Courses CRUD Functions End
     */




    /**
     * Clients CRUD Functions Start
     */
    
     //Read
     public function show_clients(){
         $clients= Client::all();
         return view('admin.view_clients', ['clients'=>$clients]);
     }

     //Create
     public function create_client(Request $req){
         $client= new Client;
         $client->name=$req->name;
         $client->email=$req->email;
         $client->admin_id=$req->admin_id;
         $client->password=Hash::make($req->password);
         
         $client->save();
         
         return view('admin.admin_panel',['NewClient'=>$client]);
     }

     //Show Client Edit Form
     public function show_client_edit_form($id){
         $client = Client::findOrFail($id);

         return view('admin.edit_client_view', ['client'=>$client]);
     }

     //Update Client Data
     public function update_client(Request $req){
         $id = $req->id;

         $client=Client::findOrFail($id);
         $client->name = $req->name;
         $client->email = $req->email;
         $client->save();

         return redirect('show_clients');
     }

     //Delete Client
     public function delete_client($id){
         $client = Client::findOrFail($id);

         $client->delete();

         return redirect('show_clients');
     }
    
     /**
      * Clien CRUD End
      */

     
    /**
     * Forgot Password Section Start
     */

    //Show View to Get User's Email
    public function show_forgot_password_view(){
        return view('admin.forgot_password');
    }

    //*********************************** */
    //  Function For *** Sending Mail  ***
    public function process_password_reset(Request $req){
        
        //First check if any Admin exists in the Database with provided Email,
        $email = $req->email;
        $admin = Admin::where('email', $email)->first();
        // If NO Admin Found with Matching Email Return Response Incorrect Email
        if(!$admin){
            return "Incorrect Email";
        }
        //Else, Send Email to Admin with Random Code
        $code=Str::random(6);
        Mail::to('ss3757761@gmail.com')->send(new password_reset('Salman', $code));

        return view('admin.verify_code',['admin'=>$admin, 'code'=>$code]);
    }

    //Take User's Input for Code and Match and Verify it with the Code Sent to Mail
    public function verify_code(Request $req){
        if ($req->code == $req->users_code){
            Session::put('id',$req->id);
            return redirect('edit_password');
        }
        else{
            return "Incorrect Code";
        }
    }

    //Show Form to Edit Password
    public function show_password_edit_view(){
        return view('admin.edit_password');
    }

    //Update Password
    public function update_password(Request $req){

        $id = Session::get('id');
     
        $admin = Admin::findOrFail($id);
        $admin->password = Hash::make($req->password);
        $admin->save();

        Session::forget('id');
        
        return view('admin.admin_login', ['message'=>'Passowrd Updated']);
    }

    /**
     * Forgot Password Section End
     */

}
