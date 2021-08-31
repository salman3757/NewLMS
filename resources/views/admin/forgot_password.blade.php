@extends('layouts.main')

@section('content')

<form action="admin_forgot_password" method="POST" class="card p-5 shadow-sm">

@csrf


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="btn btn-info my-3">Submit Email</button>

</form>

@endsection