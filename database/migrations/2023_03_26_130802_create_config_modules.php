<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('key');
            $table->longText('value')->nullable();
            $table->timestamps();
        });
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->integer('icon_category_id')->default(0);
            $table->string('name');
            $table->longText('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('icon_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('icon_sources', function (Blueprint $table) {
            $table->id();
            $table->integer('icon_category_id')->default(0);
            $table->longText('src')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('configs');
        Schema::dropIfExists('company_histories');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('icons');
        Schema::dropIfExists('icon_categories');
        Schema::dropIfExists('icon_sources');
    }
};
