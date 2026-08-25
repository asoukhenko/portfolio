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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // Название проекта
            $table->string('sphere');           // Сфера (E-commerce, Недвижимость и т.д.)
            $table->integer('year');            // Год (например, 2025)
            $table->text('description');        // Описание задач и результатов
            $table->string('cover_image')->nullable(); // Обложка/скриншот
            $table->string('project_url')->nullable();  // Ссылка на сайт
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
