@extends('layouts.main')

@section('content')

<div class="container align-center align-items-center">
<form action="/update_course" method="POST">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="name">Course Name</label>
    <input type="text" name="name" value="{{$course->name}}" class="form-control" id="name" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="description">Course Description</label>
    <input type="text"  rows="5" name="description" value="{{$course->description}}" class="form-control" id="description" required>
  </div>
  <input type="hidden" name="id" value="{{$course->id}}">
  <button type="submit" class="btn btn-primary my-3">Submit</button>
</form>
</div>

@endsection