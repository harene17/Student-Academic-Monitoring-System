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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('sub_id');
            //$table->string('subject_code');
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('semester_id')->constrained('semesters');
            $table->string('sub_name');
            $table->integer('total_credit_hr');
            $table->string('target_grade');
            //$table->string('achieve_grade')->nullable()->default(0);
            //$table->float('remaining_percentage')->nullable()->default(0);
            //$table->float('total_points')->nullable()->default(0);
            //$table->float('subject_gpa')->nullable()->default(0);
            $table ->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
