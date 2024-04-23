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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('place');
            $table->text('preview_text');
            $table->text('description');
            $table->unsignedFloat('price');
            $table->date('application_deadline');
            $table->unsignedBigInteger('industry_id');
            $table->timestamps();

            $table->index('industry_id', 'industry_conference_idx');
            $table->foreign('industry_id', 'industry_conference_fk')->on('industries')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
