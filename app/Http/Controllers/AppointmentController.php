<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  
    public function index()
    {
        $appointments = Appointment::with(['doctor','patient','service'])->get();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'nullable|in:pending,confirmed,cancelled,done',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'message' => 'تم إضافة الموعد بنجاح',
            'appointment' => $appointment
        ], 201);
    }

    public function show($id)
    {
        $appointment = Appointment::with(['doctor','patient','service'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'الموعد غير موجود'], 404);
        }

        return response()->json($appointment);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'الموعد غير موجود'], 404);
        }

        $validated = $request->validate([
            'doctor_id' => 'sometimes|exists:doctors,id',
            'patient_id' => 'sometimes|exists:patients,id',
            'service_id' => 'sometimes|exists:services,id',
            'appointment_date' => 'sometimes|date',
            'status' => 'nullable|in:pending,confirmed,cancelled,done',
        ]);

        $appointment->update($validated);

        return response()->json([
            'message' => 'تم تعديل الموعد بنجاح',
            'appointment' => $appointment
        ]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'الموعد غير موجود'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'تم حذف الموعد بنجاح']);
    }
}