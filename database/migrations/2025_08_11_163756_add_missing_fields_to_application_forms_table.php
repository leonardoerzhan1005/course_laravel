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
        Schema::table('application_forms', function (Blueprint $table) {
            // Добавляем поле для полного имени
            if (!Schema::hasColumn('application_forms', 'full_name')) {
                $table->string('full_name')->nullable()->after('phone');
            }
            
            // Добавляем поле для ID факультета
            if (!Schema::hasColumn('application_forms', 'faculty_id')) {
                $table->uuid('faculty_id')->nullable()->after('full_name');
                $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');
                $table->index('faculty_id');
            }
            
            // Добавляем поле для отметки "не преподает предметы"
            if (!Schema::hasColumn('application_forms', 'not_teaching')) {
                $table->boolean('not_teaching')->default(false)->after('teaching_subjects');
            }
            
            // Добавляем поле для заметок администратора
            if (!Schema::hasColumn('application_forms', 'notes')) {
                $table->text('notes')->nullable()->after('not_teaching');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_forms', function (Blueprint $table) {
            // Удаляем добавленные поля
            if (Schema::hasColumn('application_forms', 'notes')) {
                $table->dropColumn('notes');
            }
            
            if (Schema::hasColumn('application_forms', 'not_teaching')) {
                $table->dropColumn('not_teaching');
            }
            
            if (Schema::hasColumn('application_forms', 'faculty_id')) {
                $table->dropForeign(['faculty_id']);
                $table->dropIndex(['faculty_id']);
                $table->dropColumn('faculty_id');
            }
            
            if (Schema::hasColumn('application_forms', 'full_name')) {
                $table->dropColumn('full_name');
            }
        });
    }
};
