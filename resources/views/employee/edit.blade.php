@extends('layouts.app')
@section('content')
<div class="container">
        <h2>Edit A Product</h2><br  />
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{action('EmployeeController@update', $id)}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="firstName">first Name:</label>
                    <input type="text" class="form-control" name="firstName" value="{{$employee->firstName}}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                  <label for="lastName">last Name:</label>
                  <input type="text" class="form-control" name="lastName" value="{{$employee->lastName}}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="job">job:</label>
                    <textarea class="form-control" name="job">{{$employee->job}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                <label for="status">status: {{$employee->status}}</label>
                    <select class="form-control" name="status">
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="point">location:</label>
                    <input type="text" class="form-control" name="point" value="{{$employee->point}}" required/>
                    <a href="{{ url('/map?page=edit&id='.$employee->id) }}">get location</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="image">image:</label>
                    <img src="{{Storage::url($employee->image)}}" alt="image file is too big" class="img-thumbnail" style="width:100px;height:100px"/>
                    <input type="file" class="form-control" name="image" required>
                </div>
            </div>
          <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">Update post</button>
                </div>
          </div>
        </form>
      </div>
@endsection