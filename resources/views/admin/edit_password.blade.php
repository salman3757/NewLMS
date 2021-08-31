@extends('layouts.main')

@section('content')

<form action="update_password" method="POST" class="card p-5 shadow-sm">

@csrf


  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" >
  </div>

  <button type="submit" class="btn btn-info my-3">Reset Password</button>

</form>

@endsection