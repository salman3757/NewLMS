@extends('layouts.main')

@section('content')

<?php
$admin = Session::get('admin');
?>

<h1 class="shadow p-3 text-center my-5">WELCOME TO ADMIN PANEL <br> {{$admin['name']}}</h1>

<div class="container text-center d-flex flex-row row">
<div class="card p-3 col mx-2 manage"><a href="/show_clients" class="manage-link mx-5">Manage Clients</a></div>
<div class="card p-3 col mx-2 manage"><a href="/show_courses" class="manage-link mx-5">Manage Courses</a></div>
</div>

<!-- Messages from Controller -->
<div class="container text-center text-success my-5">
<?php 
if(isset($NewCourse)){
    echo "New Course Added - ".$NewCourse['name']; 
}
if(isset($NewClient)){
    echo "New Client Added - ".$NewClient['name']; 
}
?>
</div>

<!-- Adding Items Forms-->
<div class="row">

<!-- Add Client -->
<div class="col mb-5">
<h4 class="heading text-center">Add New Client</h4>
<form action="create_client" method="POST" class="card p-4 shadow-sm admin_add_form border-secondary border-2">

@csrf

  <div class="mb-3">
    <label for="coursename" class="form-label">Client Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="coursename" class="form-label">Client Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="coursename" class="form-label">Client Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <input type="hidden" name="admin_id" value="{{$admin['id']}}">

  <button type="submit" class="btn btn-info text-light my-3">Add Client</button>
</form>
</div>

<!-- Create Course -->
<div class="col ">
<h4 class="heading text-center">Create New Course</h4>
<form action="create_course" method="POST" class="card p-4 shadow-sm admin_add_form border-secondary border-2">
@csrf
  <div class="mb-3">
    <label for="coursename" class="form-label">Course Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="coursename" class="form-label">Course Description</label>
    <textarea rows="4" name="description" class="form-control" required></textarea>
  </div>

  <input type="hidden" name="admin_id" value="{{$admin['id']}}">

  <button type="submit" class="btn btn-info text-light my-4">Create Course</button>
</form>
</div>


</div>


@endsection