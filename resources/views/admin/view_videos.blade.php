@extends('layouts.main')

@section('content')

<h2 class="card container text-center my-5 py-3">{{$course->name}}</h2>

<!--Course Videos Section - START -->
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">URL Link</th>
      <th scope="col" colspan="2">Operations</th>
    </tr>
  </thead>
  <tbody>
  @if(isset($videos))
    @foreach($videos as $video)
    <tr>
      <th scope="row">{{$video->name}}</th>
      <td>{{$video->url}}</td>
      <td><a href="/show_video_edit_form/{{$video->id}}" class="btn btn-primary">Update</a></td>
      <td>  
            <!--Delete form, Here Not using anchor tag and Making a Form For Using DELETE method -->
            <form action = "/delete_video" method="POST">
            @csrf
            @method('DELETE')
                <input type="hidden" name="course_id" value="{{$course->id}}">
                <input type="hidden" name="video_id" value="{{$video->id}}">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
      </td>
    </tr>
@endforeach
@endif
</tbody>
</table>
<!--Course Videos Section - END -->


<!--Add New Video Section - START -->
<h3 class="text-center mt-5 mb-3">Add New Video To Course</h3>

<form action="/create_video" method="POST" class="card p-4 my-3 mb-5 shadow-sm admin_add_form">

    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Video Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="url" class="form-label">Video URL</label>
    <input type="text" name="url" class="form-control" required>
  </div>

  <input type="hidden" name="course_id" value="{{$course->id}}">

  <button type="submit" class="btn btn-info text-light my-3">Add Video</button>
</form>
<!--Add New Video Section - END -->

<!--Comments Section - START -->
<h3 class="container text-center">Comments</h3>
<div class="container comments my-5" style="margin-bottom:200px !important">
    @if(isset($comments))
        @if($comments)
            @foreach($comments as $comment)
                <div class="container card p-3 my-2">
                    <h5>
                        {{$comment->client_name}} 
                        <span style="font-size:0.8rem; font-family:courier"> at - {{$comment->created_at}}</span>
                    </h5>
                    <p>
                        {{$comment->comment_text}}
                    </p>
                </div>
            @endforeach
        @endif
    @endif
<div>
<!--Comments Section - END -->

@endsection