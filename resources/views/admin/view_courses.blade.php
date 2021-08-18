@extends('layouts.main')

@section('content')


<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Course Videos</th>
      <th scope="col" colspan="2">Operations</th>
    </tr>
  </thead>
  <tbody>

  @if(isset($courses))
    @foreach($courses as $course)
    <tr>
      <th scope="row">{{$course->name}}</th>
      <td>{{$course->description}}</td>
      <td><a href="/show_videos/{{$course->id}}" class="btn text-light btn-course">Videos</a></td>
      <td><a href="/show_course_edit_form/{{$course->id}}" class="btn btn-primary">Update</a></td>
      <td><a href="/delete_course/{{$course->id}}" class="btn btn-danger">Delete</a></td>
    </tr>
  

@endforeach
@endif
</tbody>
  </table>


@endsection