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
        Schema::table('grading_schemes', function(Blueprint $table){
            $table->string('program')->default('Diploma');
        });

        Schema::table('semesters', function(Blueprint $table){
            $table->string('program')->default('Diploma');
        });

        Schema::table('subjects', function(Blueprint $table){
            $table->string('program')->default('Diploma');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grading_schemes', function(Blueprint $table){
            $table->dropColumn('program');
        });

        Schema::table('semesters', function(Blueprint $table){
            $table->dropColumn('program');
        });

        Schema::table('subjects', function(Blueprint $table){
            $table->dropColumn('program');
        });
    }
};
