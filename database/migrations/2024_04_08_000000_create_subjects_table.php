<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->string('subject_code')->unique();
            $table->text('description')->nullable();
            $table->integer('credits')->default(3);
            $table->unsignedBigInteger('semester_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}; 