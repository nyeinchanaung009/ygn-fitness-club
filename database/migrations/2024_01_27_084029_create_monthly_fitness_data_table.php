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
        Schema::create('monthly_fitness_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            // $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->float('weight');
            $table->float('height');
            $table->float('bmi_no')->nullable();
            $table->string('bmi_status')->nullable();
            $table->float('chest_size')->nullable();
            $table->float('shoulder_size')->nullable();
            $table->float('waist_size')->nullable();
            $table->float('hip_size')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_fitness_data');
    }
};
