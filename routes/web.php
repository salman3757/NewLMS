<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Admin Registration and Login / Logout
Route::get('/admin_register', [AdminController::class, 'show_registration_form']);
Route::post('/admin_register', [AdminController::class, 'register']);

Route::get('/admin_login', [AdminController::class, 'show_login_form']);
Route::post('/admin_login', [AdminController::class, 'login']);

Route::get('/admin_logout', [AdminController::class, 'logout']);

/**
 * Admin FORGOT Password
 */
Route::get("admin_forgot_password",[AdminController::class, 'show_forgot_password_view']);
Route::post("admin_forgot_password", [AdminController::class, 'process_password_reset']);
Route::get('edit_password', [AdminController::class, 'show_password_edit_view']);
Route::post('verify_code', [AdminController::class, 'verify_code']);
Route::post('update_password', [AdminController::class, 'update_password']);
/**
 *    GROUP MIDDLEWARE 'admin' ON ( ADMIN - Panel ) and CRUD Operations, STARTS From Here
 */
Route::middleware(['admin'])->group(function ()
    {
        Route::get('/admin_panel', [AdminController::class, 'show_admin_panel']);

        //Courses CRUD
        Route::post('create_course', [AdminController::class, 'create_course']);
        Route::get('show_courses', [AdminController::class, 'show_courses']);

        Route::get('show_course_edit_form/{id}', [AdminController::class, 'show_course_edit_form']);
        Route::put('update_course', [AdminController::class, 'update_course']);
        Route::get('delete_course/{id}', [AdminController::class, 'delete_course']);


        //Client CRUD
        Route::post('create_client', [AdminController::class, 'create_client']);
        Route::get('show_clients', [AdminController::class, 'show_clients']);

        Route::get('show_client_edit_form/{id}', [AdminController::class, 'show_client_edit_form']);
        Route::put('update_client', [AdminController::class, 'update_client']);
        Route::get('delete_client/{id}', [AdminController::class, 'delete_client']);

        //show client courses
        Route::get('client_courses/{id?}', [ClientController::class, 'client_courses']);
        //Search Courses on Client's Page from Admin View, [To assign courses to clients]
        Route::get('search_client_courses', [ClientController::class, 'search_client_courses']);
        //Assign Course to client
        Route::post('assign_course', [ClientController::class, 'assign_course']);
        //De-Assign Course to client
        Route::post('de_assign_course', [ClientController::class, 'de_assign_course']);

        // Videos CRUD

        Route::get('show_videos/{course_id?}', [VideoController::class, 'show_videos']);
        Route::post('create_video', [VideoController::class, 'create_video']);
        Route::get('show_video_edit_form/{id}', [VideoController::class, 'show_video_edit_form']);
        Route::put('update_video', [VideoController::class, 'update_video']);
        Route::delete('delete_video', [VideoController::class, 'delete_video']);

    });
/**
 * Group Middleware 'admin' ENDS Here
 */



//Client-SIDE VIEWs
//Home
Route::get('client_home', [ClientController::class, 'show_client_home']);

//Client Login / Logout
Route::get('client_login', [ClientController::class, 'show_login_form']);
Route::post('client_login', [ClientController::class, 'login']);

Route::get('client_logout', [ClientController::class, 'logout']);

//Show Courses To Client
Route::get('show_course_client/{course_id}', [ClientController::class, 'show_course']);

//Comments 
Route::post('create_comment', [CommentController::class, 'create_comment']);