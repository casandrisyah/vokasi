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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->timestamp('date');
            $table->longText('title');
            $table->longText('category');
            $table->longText('slug');
            $table->string('thumbnail');
            $table->string('type')->nullable();
            $table->longText('description');
            $table->longText('location');
            $table->longText('url')->nullable();
            $table->boolean('st')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('fundings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->longText('project_name');
            $table->longText('organizer');
            $table->longText('involved_parties');
            $table->longText('working_time');
            $table->longText('working_area');
            $table->longText('type');
            $table->longText('desc')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('slug');
            $table->string('thumbnail');
            $table->string('created_by');
            $table->longText('desc');
            $table->boolean('is_primary')->default(false);
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
        Schema::dropIfExists('activities');
        Schema::dropIfExists('news');
    }
};
