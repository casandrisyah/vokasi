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
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->longText('thumbnail')->nullable();
            $table->longText('faculty')->nullable();
            $table->longText('university')->nullable();
            $table->longText('facebook_url')->nullable();
            $table->longText('instagram_url')->nullable();
            $table->longText('youtube_url')->nullable();
            $table->longText('linkedin_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('web_footers', function (Blueprint $table) {
            $table->id();
            $table->longText('section')->nullable();
            $table->longText('text')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::table('web_footers')->insert([
            ['section' => 'tentang', 'text' => 'Sejarah', 'url' => 'route("web.tentang")', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'tentang', 'text' => 'Visi dan Misi', 'url' => 'route("web.tentang")', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'tentang', 'text' => 'Struktur Organisasi', 'url' => 'route("web.tentang")', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'program studi', 'text' => 'D-III Teknologi Informasi', 'url' => '/program/d-iii-teknologi-informasi', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'program studi', 'text' => 'D-III Teknologi Komputer', 'url' => '/program/d-iii-teknologi-komputer', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'program studi', 'text' => 'Sarjana Terapan Teknologi Rekayasa Perangkat Lunak', 'url' => '/program/sarjana-terapan-teknologi-rekayasa-perangkat-lunak', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'aktivitas mahasiswa', 'text' => 'Himatek', 'url' => '/aktivitas/himatek', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'aktivitas mahasiswa', 'text' => 'Himatif', 'url' => '/aktivitas/himatif', 'created_at' => now(), 'updated_at' => now()],
            ['section' => 'aktivitas mahasiswa', 'text' => 'Himatera', 'url' => '/aktivitas/himatera', 'created_at' => now(), 'updated_at' => now()],
        ]);
        Schema::create('pak_simulations', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('logos');
        Schema::dropIfExists('web_footers');
        Schema::dropIfExists('pak_simulations');
    }
};
