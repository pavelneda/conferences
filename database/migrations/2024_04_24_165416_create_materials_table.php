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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('author');
            $table->string('university');
            $table->string('phone');
            $table->string('email');
            $table->string('path');
            $table->string('url');
            $table->unsignedBigInteger('industry_id');
            $table->timestamps();

            $table->index('industry_id', 'industry_materials_idx');
            $table->foreign('industry_id', 'industry_materials_fk')->on('industries')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
