<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {

        $doctors = Doctor::with('department')->get();

        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
        ]);

        $doctor = Doctor::create($validated);

        return response()->json([
            'message' => 'تم إضافة الطبيب بنجاح',
            'doctor' => $doctor
        ], 201);
    }
    public function show($id)
    {
        $doctor = Doctor::with('department')->find($id);

        if (!$doctor) {
            return response()->json(['message' => 'الطبيب غير موجود'], 404);
        }

        return response()->json($doctor);
    }

    
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'الطبيب غير موجود'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'sometimes|exists:departments,id',
        ]);
        $doctor->update($validated);

        return response()->json([
            'message' => 'تم تعديل بيانات الطبيب',
            'doctor' => $doctor
        ]);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'الطبيب غير موجود'], 404);
        }

        $doctor->delete();

        return response()->json(['message' => 'تم حذف الطبيب بنجاح']);
    }
}