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
        Schema::create('sub_assessments', function (Blueprint $table) {
            $table->id('SubAssessment_id');
            $table->foreignId('assessment_id')->constrained('assessments');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->string('subAssessmentName');
            $table->float('total_mark');
            $table->float('obtained_mark');
            $table ->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_assessments');
    }
};
