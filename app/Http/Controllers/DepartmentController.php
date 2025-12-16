<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return Department::orderBy('id','desc')->paginate(10);
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $dep = Department::create($request->only(['name','description']));

        return response()->json([
            'message' => 'تمت إضافة القسم بنجاح',
            'department' => $dep
        ], 201);
    }

    public function show($id)
    {
        $dep = Department::findOrFail($id);
        return $dep;
    }

    public function update(Request $request, $id)
    {
        $dep = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $dep->update($request->only(['name','description']));

        return response()->json(['message' => 'تم التحديث','department' => $dep]);
    }


    public function destroy($id)
    {
        Department::destroy($id);
        return response()->json(['message' => 'تم الحذف']);
    }
}