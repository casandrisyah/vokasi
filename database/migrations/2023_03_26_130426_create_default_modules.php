<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
        Schema::create('days', function (Blueprint $table) {
            $table->id();
        });
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('user_categories', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->string('role');
            $table->longText('slug');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_category_id')->nullable()->index();
            $table->string('nidn')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('sinta_id')->nullable();
            $table->string('place_birth')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('skill')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone',20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->longText('bio')->nullable();
            $table->longText('url')->nullable();
            $table->string('avatar')->nullable();
            $table->longText('position')->nullable();
            $table->longText('biografi')->nullable();
            $table->longText('ikhtisar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('user_categories')->insert([
            ['name' => 'D-III Teknologi Komputer', 'role' => '3', 'slug' => 'd-iii-teknologi-komputer', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D-III Teknologi Informasi', 'role' => '3', 'slug' => 'd-iii-teknologi-informasi', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarjana Terapan Teknologi Rekayasa Perangkat Lunak', 'role' => '3', 'slug' => 'sarjana-terapan-teknologi-rekayasa-rerangkat-lunak', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D-III Teknologi Komputer', 'role' => '4', 'slug' => 'd-iii-teknologi-komputer', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D-III Teknologi Informasi', 'role' => '4', 'slug' => 'd-iii-teknologi-informasi', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarjana Terapan Teknologi Rekayasa Perangkat Lunak', 'role' => '4', 'slug' => 'sarjana-terapan-teknologi-rekayasa-rerangkat-lunak', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asisten Dosen Fakultas Vokasi', 'role' => '5', 'slug' => 'asisten-dosen-fakultas-vokasi', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BAAK Fakultas Vokasi', 'role' => '5', 'slug' => 'baak-fakultas-vokasi', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Himatek', 'role' => '6', 'slug' => 'himatek', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Himatif', 'role' => '6', 'slug' => 'himatif', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Himatera', 'role' => '6', 'slug' => 'himatera', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('users')->insert([
            ['user_category_id' => null, 'name' => 'Administrator', 'email' => 'demo@admin.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => null, 'name' => 'Dekan', 'email' => 'demo@dekan.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => 4, 'name' => 'Dosen', 'email' => 'demo@dosen.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => 7, 'name' => 'Staf', 'email' => 'demo@staf.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => 9, 'name' => 'Himatek', 'email' => 'demo@himatek.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => 10, 'name' => 'Himatif', 'email' => 'demo@himatif.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['user_category_id' => 11, 'name' => 'Himatera', 'email' => 'demo@himatera.com', 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role' => '6', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    public function down()
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('days');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
