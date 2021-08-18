@extends('layouts.main')

@section('content')

<?php
$client = Session::get('client');
?>

<h1 class="text-center my-5">WELCOME TO Client Section - {{$client['name']}}</h1>


@if(isset($courses))
@if($courses)
<div class="container p-5 border border-dark border-2 text-center">
<h3 class="mb-4 border-bottom border-dark border-2 pb-2">Assigned Courses</h3>
@foreach($courses as $course)
<a href="show_course_client/{{$course->id}}"><h5 class="btn-primary py-3">{{$course->name}}</h5></a>
@endforeach
</div>
@endif
@endif


@endsection