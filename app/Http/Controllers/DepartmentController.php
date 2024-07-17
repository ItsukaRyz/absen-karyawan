<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();

        return view('pages.department.index')->with(compact('departments'));;
    }

    public function create()
    {
        return view('pages.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);


        $department = new Department;
        $department->name = $request->name;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
}
