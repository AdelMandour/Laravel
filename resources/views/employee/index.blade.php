@extends('layouts.app')
@section('content')
    <div class="container">
            @if (\Session::has('success'))
            <div class="alert alert-success">
              <p>{{ \Session::get('success') }}</p>
            </div><br />
           @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Image</th>
                    <th>Job</th>
                    <th>Status</th>
                    <th>Point</th>
                    <th>login name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->firstName}}</td>
                        <td>{{$employee->lastName}}</td>
                        <td><img src="{{Storage::url($employee->image)}}" alt="image file is too big" class="img-thumbnail" style="width:100px;height:100px"/></td>
                        <td>{{$employee->job}}</td>
                        <td>{{$employee->status}}</td>
                        <td>{{$employee->point}}</td>
                        <td>{{$employee->user->name}}</td>
                        <td><a href="{{action('EmployeeController@edit', $employee->id)}}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="{{action('EmployeeController@destroy', $employee->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection