<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseApiController;
use App\Http\Controllers\ClientApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('courses', CourseApiController::class);

Route::resource('clients', ClientApiController::class);


//Random Functions
//courses
Route::get('clients/get_client_courses/{id}', [ClientApiController::class, 'get_client_courses']); // id is Client's id
Route::post('clients/attach_course', [ClientApiController::class, 'attach_course']);
Route::post('clients/detach_course', [ClientApiController::class, 'detach_course']);

//videos
Route::get('courses/get_course_videos/{id}', [CourseApiController::class, 'get_course_videos']); // id is Course's id
Route::get('courses/get_course_comments/{id}', [CourseApiController::class, 'get_course_comments']); // id is Course's id
Route::post('courses/add_assign_video', [CourseApiController::class, 'add_assign_video']);
Route::delete('courses/delete_video/{id}', [CourseApiController::class, 'delete_video']);
Route::get('courses/edit_video/{id}', [CourseApiController::class, 'edit_video']);
Route::put('courses/update_video/{id}', [CourseApiController::class, 'update_video']);