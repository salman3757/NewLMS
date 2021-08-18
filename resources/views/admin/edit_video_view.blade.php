@extends('layouts.main')

@section('content')


<div class="container align-center align-items-center">
<form action="/update_video" method="POST">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="name">Video Name</label>
    <input type="text" name="name" value="{{$video->name}}" class="form-control" id="name"  required>
  </div>
  <div class="form-group">
    <label for="description">Video URL</label>
    <input type="text"  name="url" value="{{$video->url}}" class="form-control"  required>
  </div>
  <input type="hidden" name="video_id" value="{{$video->id}}">
  <input type="hidden" name="course_id" value="{{$video->course_id}}">
  <button type="submit" class="btn btn-primary my-3">Submit</button>
</form>
</div>


@endsection