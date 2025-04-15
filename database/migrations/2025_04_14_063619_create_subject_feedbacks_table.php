<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('subject_feedbacks')) {
            Schema::create('subject_feedbacks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cr_id')->constrained('crs')->onDelete('cascade');
                $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
                $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
                $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
                $table->text('feedback');
                $table->integer('rating')->nullable();
                $table->boolean('is_anonymous')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_feedbacks');
    }
}; 