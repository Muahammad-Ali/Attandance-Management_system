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
        Schema::create('semester_crs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('cr_id');
            $table->timestamps();
            
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('cr_id')->references('id')->on('crs')->onDelete('cascade');
            
            $table->unique(['semester_id', 'cr_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_crs');
    }
};
