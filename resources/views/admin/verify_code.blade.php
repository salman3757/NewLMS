@extends('layouts.main')

@section('content')

<form action="verify_code" method="POST" class="card p-5 shadow-sm">

@csrf


  <div class="mb-3">
    <label for="code" class="form-label">Enter 6-Digit Code</label>
    <input type="text" name="users_code" class="form-control" id="code">
  </div>

  <input type="hidden" name="code" value="{{$code}}">
  <input type="hidden" name="id" value="{{$admin->id}}">

  <button type="submit" class="btn btn-info my-3">Submit</button>

</form>

@endsection