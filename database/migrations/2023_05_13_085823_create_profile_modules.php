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
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('year', 4);
            $table->longText('knowledge_field');
            $table->longText('university');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->longText('title');
            $table->date('date');
            $table->longText('published');
            $table->longText('url');
            $table->longText('desc')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('teaching_mentorings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->longText('category');
            $table->longText('title');
            $table->longText('student_name')->nullable();
            $table->longText('year');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('staff_teachings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->year('year')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('prodi')->nullable();
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
        Schema::dropIfExists('educational_backgrounds');
        Schema::dropIfExists('researches');
        Schema::dropIfExists('teaching_mentorings');
        Schema::dropIfExists('staff_teachings');
    }
};
