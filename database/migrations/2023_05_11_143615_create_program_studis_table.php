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
        Schema::create('category_prodis', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('slug');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::table('category_prodis')->insert([
            ['name' => 'D-III Teknologi Informasi', 'slug' => 'd-iii-teknologi-informasi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D-III Teknologi Komputer', 'slug' => 'd-iii-teknologi-komputer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarjana Terapan Teknologi Rekayasa Perangkat Lunak', 'slug' => 'sarjana-terapan-teknologi-rekayasa-perangkat-lunak', 'created_at' => now(), 'updated_at' => now()],
        ]);
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->integer('category_prodi_id');
            $table->longText('definisi');
            $table->longText('sejarah');
            $table->longText('visi');
            $table->longText('misi');
            $table->longText('tujuan');
            $table->longText('link')->nullable();
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
        Schema::dropIfExists('category_prodi');
        Schema::dropIfExists('program_studis');
    }
};
