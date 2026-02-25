<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('department_id', 'DESC')->paginate(3);

        return view('backend.settings.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prefix = 'DPT';
        $timestamp = now()->format('YmdHis');
        $random = strtoupper(substr(md5(uniqid('deptcode', true)), 0, 6));
        $randomCode = $prefix . $timestamp . '-' . $random;

        return view('backend.settings.departments.create')->with('randomCode', $randomCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_code' => 'required|max:50|unique:departments,department_code',
            'department_name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
            'department_description' => 'required|max:255',
            'department_status' => 'required|in:active,inactive',
        ]);

        Department::create([
            'department_code' => $validated['department_code'],
            'department_name' => $validated['department_name'],
            'description' => $validated['department_description'],
            'department_status' => $validated['department_status'],
        ]);

        session()->flash('toast_success', 'Department created successfully!');

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('backend.settings.departments.view', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('backend.settings.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'department_code' => 'required|max:50|unique:departments,department_code,' . $department->getKey() . ',department_id',
            'department_name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
            'department_description' => 'required|max:255',
            'department_status' => 'required|in:active,inactive',
        ]);

        $department->update([
            'department_code' => $validated['department_code'],
            'department_name' => $validated['department_name'],
            'description' => $validated['department_description'],
            'department_status' => $validated['department_status'],
        ]);

        session()->flash('toast_success', 'Department updated successfully!');

        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        session()->flash('toast_success', 'Department deleted successfully!');

        return redirect()->route('department.index');
    }
}
