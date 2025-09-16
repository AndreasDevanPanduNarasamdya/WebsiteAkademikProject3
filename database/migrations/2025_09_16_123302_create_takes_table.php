<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('takes', function (Blueprint $table) {
            $table->id('takes_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->date('enroll_date');
            $table->decimal('grade', 4, 2)->nullable();
            $table->enum('status', ['active', 'completed', 'dropped'])->default('active');
            $table->timestamps();
            
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('takes');
    }
};
