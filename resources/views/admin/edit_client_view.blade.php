@extends('layouts.main')

@section('content')

<div class="container align-center align-items-center">
<form action="/update_client" method="POST">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="name">Client Name</label>
    <input type="text" name="name" value="{{$client->name}}" class="form-control" id="name"  required>
  </div>
  <div class="form-group">
    <label for="description">Client Email</label>
    <input type="text"  name="email" value="{{$client->email}}" class="form-control"  required>
  </div>
  <input type="hidden" name="id" value="{{$client->id}}">
  <button type="submit" class="btn btn-primary my-3">Submit</button>
</form>
</div>

@endsection