<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->longText('title')->nullable();
            $table->longText('desc')->nullable();
            $table->string('url');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('authors')->nullable();
            $table->string('license')->nullable();
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_swup')->default(false);
            $table->timestamps();
        });
        Schema::create('theme_javascripts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('theme_id');
            $table->longText('file');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_editable')->default(false);
            $table->boolean('is_guest')->default(false);
            $table->boolean('is_auth')->default(false);
            $table->timestamps();
        });
        Schema::create('theme_stylesheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('theme_id');
            $table->longText('file');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_editable')->default(false);
            $table->boolean('is_guest')->default(false);
            $table->boolean('is_auth')->default(false);
            $table->timestamps();
        });
        Schema::create('breaking_news_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->integer('limit')->default(12);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('civitas_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('thumbnail')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('faculty_explore_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('text_under_title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('faculty_items_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('thumbnail')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('study_program_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('thumbnail')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('meet_our_students_sections', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('thumbnail')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carousels');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('theme_javascripts');
        Schema::dropIfExists('theme_stylesheets');
        Schema::dropIfExists('breaking_news_sections');
        Schema::dropIfExists('civitas_sections');
        Schema::dropIfExists('faculty_explore_sections');
        Schema::dropIfExists('faculty_items_sections');
        Schema::dropIfExists('study_program_sections');
        Schema::dropIfExists('meet_our_students_sections');
    }
};
