<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->paginate(10);
        
        return view('backend.employees.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::where('status', 'active')->get();
        $departments = Department::orderBy('department_name')->get();

        return view('backend.employees.create', compact('positions', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|regex:/^\d{9,10}$/',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,department_id',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive,terminated',
        ]);

        $position = Position::find($request->input('position_id'));
        $department = Department::where('department_id', $request->input('department_id'))->first();

        $data = $request->only(['first_name','last_name','email','phone','salary','hire_date','status']);
        $data['position_id'] = $request->input('position_id');
        $data['department_id'] = $request->input('department_id');
        // keep legacy string fields for compatibility
        $data['position'] = $position ? $position->name : null;
        $data['department'] = $department ? $department->department_name : null;

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo_path'] = $request->file('profile_photo')->store('employees/photos', 'public');
        }

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('backend.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $positions = Position::where('status', 'active')->get();
        $departments = Department::orderBy('department_name')->get();

        return view('backend.employees.edit', compact('employee','positions','departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|regex:/^\d{9,10}$/',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,department_id',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive,terminated',
        ]);

        $position = Position::find($request->input('position_id'));
        $department = Department::where('department_id', $request->input('department_id'))->first();

        $data = $request->only(['first_name','last_name','email','phone','salary','hire_date','status']);
        $data['position_id'] = $request->input('position_id');
        $data['department_id'] = $request->input('department_id');
        $data['position'] = $position ? $position->name : null;
        $data['department'] = $department ? $department->department_name : null;

        if ($request->hasFile('profile_photo')) {
            if ($employee->profile_photo_path) {
                Storage::disk('public')->delete($employee->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo')->store('employees/photos', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
