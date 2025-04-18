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
        Schema::create('crs', function (Blueprint $table) {
            $table->id();
            $table->string('cr_name');
            $table->string('cr_email')->unique();
            $table->string('reg_no');
            $table->string('section');
            $table->string('semester');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crs');
    }
};
