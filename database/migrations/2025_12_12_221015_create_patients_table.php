<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up(): void
{
    Schema::create('patients', function (Blueprint $table) {
        $table->id(); // رقم المريض
        $table->string('name'); // الاسم
        $table->string('email')->nullable()->unique(); // البريد الإلكتروني
        $table->string('phone')->nullable(); // الهاتف
        $table->enum('gender', ['male', 'female'])->nullable(); // الجنس
        $table->date('date_of_birth')->nullable(); // تاريخ الميلاد
        $table->string('address')->nullable(); // العنوان
        $table->timestamps(); // تاريخ الإنشاء والتعديل
    });
}
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
