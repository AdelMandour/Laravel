<?php

namespace App\Http\Controllers;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EmployeeController extends Controller
{
    //
    public function index(){
        if (Auth::check()) {
            $employees = Employee::all();
            return view('employee.index', compact('employees'));
        }else{
            return back();
        }
    }
    public function create(Request $request){
        if(Auth::check()){
            $address = $request->address;
            return view('employee.create', compact('address'));
        }else{
            return back();
        }
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            $imagename = "";
            if ($request->hasFile('image')) {
                $imagename = $request->image->store('public');
            }
            $this->validate(request(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'password' => 'required',
                'image' => 'required',
            ]);
            $user = new User();
            $user->name=$request->firstName.$request->lastName;
            $user->email=$request->firstName.$request->lastName;
            $user->password=bcrypt($request->password);
            $user->save();
            $employee = new Employee();
            $employee->firstName = $request->firstName;
            $employee->lastName = $request->lastName;
            $employee->job = $request->job;
            $employee->status = $request->status;
            $employee->point = $request->point;
            $employee->image = $imagename;
            $employee->user_id=$user->id;
            $employee->save();
            return back()->with('success', 'employee has been added');
        } else {
            return back();
        }
    }
    public function edit(Request $request,$id)
    {
        if (Auth::check()) {
            $employee = Employee::find($id);
            $address = $request->address;
            //dd($address);
            if ($address != null){
                $employee->point=$address;
            }
            return view('employee.edit', compact('employee', 'id'));
        }else {
            return back();
       }
    }
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $employee = Employee::find($id);
            $this->validate(request(), [
                'firstName' => 'required',
                'lastName' => 'required',
            ]);
            $imagename = "";
            if ($request->hasFile('image')) {
                $imagename = $request->image->store('public');
            }
            $employee->firstName = $request->firstName;
            $employee->lastName = $request->lastName;
            $employee->job = $request->job;
            $employee->status = $request->status;
            $employee->point = $request->point;
            if ($imagename != ""){
                $employee->image = $imagename;
            }
            $employee->save();
            return redirect('employees')->with('success', 'employee has been updated');
        }else {
            return back();
       }
    }
    public function destroy($id)
    {
        if (Auth::check()) {
            $employee = Employee::find($id);
            $employee->delete();
            return redirect('employees')->with('success', 'employee has been  deleted');
        }else {
            return back();
       }
    }
    public function show(Request $request)
    {
        $employees = Employee::all()->where('firstName',$request->name);
        return view('employee.index', compact('employees'));
    }
    public function map()
    {
        dd("map");
        //return view('employee.map');
    }
}
