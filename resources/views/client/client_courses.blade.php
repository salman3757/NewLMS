@extends('layouts.main')

@section('content')


<table class="table">
  <thead>
    <tr>
      <th scope="col">Course name</th>
    </tr>
  </thead>
  <tbody>
  @if(isset($courses) && !empty($courses))
  @foreach($courses as $course)
    <tr>
      <td scope="row" class="table-info">{{$course->name}}</td>

      <td> <form action="/de_assign_course" method="POST" class="">
                 @csrf
                <input type="submit" class="btn btn-warning" Value="De - Assign Course">
                
                <input type="hidden" name="course_id" value={{$course->id}}>
                <input type="hidden" name="client_courses" value={{$courses}}> <?php //$courses is the Array of Courses Already assigned to the client ?>

            </form>
       </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>

<div class="container align-items-center align-center my-5">
    <h3 class="pb-3 border-bottom border-dark text-center border-2">Search Courses</h3>
    <form class="form-inline" action="/search_client_courses" method="GET">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" name="search" class="form-control" id="search" placeholder="Search Courses">
        </div>
        <input type="hidden" name="client_courses" value={{$courses}}>
            <button type="submit" class="btn btn-primary mb-2 search_btn">Search</button>
    </form>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Course name</th>
    </tr>
  </thead>
  <tbody>
  @if(isset($searched_courses))
  @foreach($searched_courses as $course)
    <tr >
      <td scope="row" class="table-info">{{$course->name}}</td>

      <td scope="row" class="table-info" >
           <form action="/assign_course" method="POST" class="">
                 @csrf
                <input type="submit" class="btn btn-primary" Value="Assign Course">
                <input type="hidden" name="course_id" value={{$course->id}}>

                <input type="hidden" name="client_courses" value={{$courses}}> <?php //$courses is the Array of Courses Already assigned to the client ?>

            </form>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>

@endsection