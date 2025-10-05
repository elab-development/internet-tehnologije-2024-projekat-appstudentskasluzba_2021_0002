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
        Schema::create('upisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('studenti')->cascadeOnDelete();
            $table->foreignId('predmet_id')->constrained('predmeti')->cascadeOnDelete();
            $table->enum('status',['upisan','polozio','pao'])->default('upisan');
            $table->unsignedTinyInteger('ocena')->nullable(); // 6-10
            $table->timestamps();
            $table->unique(['student_id','predmet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upisi');
    }
};
