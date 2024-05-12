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
        Schema::table('conferences', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->index('industry_id', 'industry_conference_idx');
            $table->foreign('industry_id', 'industry_conference_fk')->on('industries')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropForeign('industry_conference_fk');
            $table->dropIndex('industry_conference_idx');
        });
    }
};
