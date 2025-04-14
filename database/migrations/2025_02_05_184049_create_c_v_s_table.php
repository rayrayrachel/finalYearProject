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
        Schema::create('c_v_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('application_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->unique('application_id');
            $table->json('contact_information');
            $table->json('personal_statement')->nullable();
            $table->json('professional_experiences')->nullable();
            $table->json('educations')->nullable();
            $table->json('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_v_s');
    }
};
