<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->longText('desc');
            $table->string('year',4);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::table('histories')->insert([
            ['year' => 2013, 'desc' => 'Politeknik Informatika Del (PI Del) mengembangkan fungsi akademiknya menjadi Institut Teknologi Del (IT Del) pada tanggal 5 Juli, dengan program Sarjana, Diploma IV, dan Diploma III.', 'created_at' => now(), 'updated_at' => now()],
            ['year' => 2013, 'desc' => 'Politeknik Informatika Del (PI Del) mengembangkan fungsi akademiknya menjadi Institut Teknologi Del (IT Del) pada tanggal 5 Juli, dengan program Sarjana, Diploma IV, dan Diploma III.', 'created_at' => now(), 'updated_at' => now()],
            ['year' => 2013, 'desc' => 'Politeknik Informatika Del (PI Del) mengembangkan fungsi akademiknya menjadi Institut Teknologi Del (IT Del) pada tanggal 5 Juli, dengan program Sarjana, Diploma IV, dan Diploma III.', 'created_at' => now(), 'updated_at' => now()],
        ]);
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('thumbnail')->nullable();
            $table->smallInteger('order');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('visions', function (Blueprint $table) {
            $table->id();
            $table->longText('visi');
            $table->longText('misi');
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
        Schema::dropIfExists('histories');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('visions');
    }
};
