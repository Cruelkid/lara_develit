<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->paginate(10);

        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),

            //This is just for testing CRUD.
            //In test there is no such task as connect company to user and then connect it to employee.
            //So this is temporary decision.
            'company' => $request->user()->company,
            
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        if ($employee) {
            return redirect()->route('employees.show', [
                'employee' => $employee->id
            ])->with('success', 'Employee created successfully!');
        }

        return back()->withInput()->with('error', 'Error in creating new employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee = Employee::find($employee->id);

        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::find($employee->id);

        return view('employees.edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        
        $employeeUpdate = Employee::where('id', $employee->id)->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),

            //This is just for testing CRUD.
            //In test there is no such task as connect company to user and then connect it to employee.
            //So this is temporary decision.
            'company' => $request->user()->company,

            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        if ($employeeUpdate) {
            return redirect()->route('employees.show', [
                'employee' => $employee->id
            ])->with('success', 'Employee updated successfully!');
        }

        return back()->withInput()->with('error', 'Error in updating employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employeeDelete = Employee::find($employee->id);

        if ($employeeDelete->delete()) {
            return redirect()->route('employees.index')
                ->with('success', 'Employee deleted succesfully!');
        }

        return back()->withInput()->with('error', 'Employee cannot be deleted.');
    }
}
