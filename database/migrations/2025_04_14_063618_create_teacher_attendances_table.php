<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('teacher_attendances')) {
            Schema::create('teacher_attendances', function (Blueprint $table) {
                $table->id();
                $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
                $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
                $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
                $table->date('date');
                $table->string('day');
                $table->time('start_time');
                $table->time('end_time');
                $table->enum('status', ['present', 'absent', 'late'])->default('present');
                $table->text('remarks')->nullable();
                $table->foreignId('recorded_by')->constrained('crs')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
}; 