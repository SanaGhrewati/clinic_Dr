<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:patients,email',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        $patient = Patient::create($validated);

        return response()->json([
            'message' => 'تم إضافة المريض بنجاح',
            'patient' => $patient
        ], 201);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'المريض غير موجود'], 404);
        }

        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'المريض غير موجود'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'nullable|email|unique:patients,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        $patient->update($validated);

        return response()->json([
            'message' => 'تم تعديل بيانات المريض',
            'patient' => $patient
        ]);
    }
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'المريض غير موجود'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'تم حذف المريض بنجاح']);
    }
}