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
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('faculty_id')->nullable()->after('category_id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');
            $table->index('faculty_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->dropIndex(['faculty_id']);
            $table->dropColumn('faculty_id');
        });
    }
};
