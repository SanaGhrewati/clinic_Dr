<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service = Service::create($validated);

        return response()->json([
            'message' => 'تم إضافة الخدمة بنجاح',
            'service' => $service
        ], 201);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'الخدمة غير موجودة'], 404);
        }

        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'الخدمة غير موجودة'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service->update($validated);

        return response()->json([
            'message' => 'تم تعديل الخدمة بنجاح',
            'service' => $service
        ]);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'الخدمة غير موجودة'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'تم حذف الخدمة بنجاح']);
    }
}