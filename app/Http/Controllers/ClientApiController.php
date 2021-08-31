<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Create a New Instance of ClientResource Class which returns the passed Object's name, description
        // and admin_id. As was Desfined in the toArray Method of the Class
        return ClientResource::collection(Client::all());
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
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->admin_id = $request->admin_id;
        $client->save();

        return new ClientResource($client);
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
        return new ClientResource(Client::findOrFail($id));
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
        $client = Client::findOrFail($id);
        return new ClientResource($client);
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
        $client = Client::findOrFail($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->save();
        return new ClientResource($client);
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
        $client = Client::findOrFail($id);
        $result = $client->delete();

        return $result;

        //OR

        // $result = Client::destroy($id);
        // return $result;
    }

    /**
      * Other functions section start
      */

      //get Courses of One Client
      public function get_client_courses($id){
        $client = Client::findOrFail($id);
        $courses = $client->courses;
        return $courses;
    }

    
    // This kind of Attaching and Detaching is Suitable for Many to Many Relationships
    // , In case of one to one and one to many, attachment is done when inserting data in database as a 
    // foreign key of other field

    public function attach_course(Request $request){
        $course_id = $request->course_id;
        $client_id = $request->client_id;

        $client = Client::findOrFail($client_id);
        $client->courses()->attach($course_id);
        
    }

    public function detach_course(Request $request){
        $client_id = $request->client_id;
        $course_id = $request->course_id;

        $client = Client::findOrFail($client_id);

        $client->courses()->detach($course_id);
    }
    
}
