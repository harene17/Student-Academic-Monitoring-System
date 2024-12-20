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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id('sem_id');
            $table->foreignId('student_id')->constrained('users');
           // $table->string('academic_year');
            $table->integer('semester');
            $table->integer('total_credit_hr');
            $table->float('target_gpa');
           // $table->float('achieve_gpa')->nullable()->default(0);
            $table ->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
