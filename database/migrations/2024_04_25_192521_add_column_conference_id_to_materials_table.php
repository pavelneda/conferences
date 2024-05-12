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
        Schema::table('materials', function (Blueprint $table) {
            $table->unsignedBigInteger('conference_id');

            $table->index('conference_id', 'conference_materials_idx');
            $table->foreign('conference_id', 'conference_materials_fk')->on('conferences')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign('conference_materials_fk');
            $table->dropIndex('conference_materials_idx');
            $table->dropColumn('conference_id');
        });
    }
};
