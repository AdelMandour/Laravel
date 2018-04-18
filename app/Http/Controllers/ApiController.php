<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
class ApiController extends Controller
{
    //
    public function index(){
        return Employee::all();
    }
    public function getbyname(Request $request){
        return Employee::all()->where('firstName',$request->firstName);
    }
}
