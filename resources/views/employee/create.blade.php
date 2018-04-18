@extends('layouts.app')
@section('content')
@if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif
<form method="post" action="{{url('employees')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="firstName">first name:</label>
        <input type="text" class="form-control" name="firstName" required>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="lastName">last name:</label>
            <input type="text" class="form-control" name="lastName" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="password">password:</label>
            <input type="text" class="form-control" name="password" required>
        </div>
    </div>
    <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="job">job:</label>
          <textarea class="form-control" name="job" style="resize:none"></textarea>
        </div>
      </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="status">status:</label>
            <select name="status">
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
            </select>
        </div>
    </div>
    <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
            <label for="point">location:</label>
            <input type="text" class="form-control" name="point" value="{{$address}}">
                <a href="{{ url('/map?page=create') }}">get location</a>
            </div>
        </div>
    <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="image">image:</label>
          <input type="file" class="form-control" name="image" required>
        </div>
      </div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success" style="margin-left:38px">Add Employee</button>
      </div>
    </div>
  </form>
@endsection