@extends('layouts.main')

@section('content')


<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Courses</th>
      <th scope="col" colspan="2">Operations</th>
    </tr>
  </thead>
  <tbody>

  @if(isset($clients))
    @foreach($clients as $client)
    <tr>
      <th scope="row">{{$client->name}}</th>
      <td>{{$client->email}}</td>
      <td><a href="/client_courses/{{$client->id}}" class="btn btn-secondary btn-course">Courses</a></td>
      <td><a href="/show_client_edit_form/{{$client->id}}" class="btn btn-primary">Update</a></td>
      <td><a href="/delete_client/{{$client->id}}" class="btn btn-danger">Delete</a></td>
    </tr>
  

@endforeach
@endif
</tbody>
  </table>


@endsection