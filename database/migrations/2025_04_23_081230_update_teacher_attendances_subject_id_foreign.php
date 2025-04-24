<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In the migration file
public function up()
{
    Schema::table('teacher_attendances', function (Blueprint $table) {
        // Remove old foreign key if it exists
        $table->dropForeign(['subject_id']);
        
        // Add new foreign key constraint
        $table->foreign('subject_id')
              ->references('id')
              ->on('assigned_subjects')
              ->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
