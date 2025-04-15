<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->unsignedBigInteger('semester_id')->after('id');
            $table->unsignedBigInteger('subject_id')->after('semester_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->after('subject_id')->nullable();
            $table->unsignedBigInteger('cr_id')->after('teacher_id')->nullable();
            $table->string('day')->after('cr_id')->nullable();
            $table->time('start_time')->after('day')->nullable();
            $table->time('end_time')->after('start_time')->nullable();
            $table->string('classroom')->after('end_time')->nullable();
            $table->text('notes')->after('classroom')->nullable();
            
            // Add foreign key constraints
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('assigned_subjects')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->foreign('cr_id')->references('id')->on('crs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['cr_id']);
            
            // Drop columns
            $table->dropColumn([
                'semester_id',
                'subject_id',
                'teacher_id',
                'cr_id',
                'day',
                'start_time',
                'end_time',
                'classroom',
                'notes'
            ]);
        });
    }
};
