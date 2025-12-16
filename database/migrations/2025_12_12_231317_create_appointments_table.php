<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // رقم الموعد
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // رابط الطبيب
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // رابط المريض
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // رابط الخدمة
            $table->dateTime('appointment_date'); // تاريخ ووقت الموعد
            $table->enum('status', ['pending','confirmed','cancelled','done'])->default('pending'); // حالة الموعد
            $table->timestamps(); // created_at و updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};