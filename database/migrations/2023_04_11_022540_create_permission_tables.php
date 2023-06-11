<?php

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));

            $permissions = array(
                [
                    'name' => Str::slug('Dashboard'),
                ],
                [
                    'name' => Str::slug('Create Carousel'),
                ],
                [
                    'name' => Str::slug('Edit Carousel'),
                ],
                [
                    'name' => Str::slug('View Carousel'),
                ],
                [
                    'name' => Str::slug('Delete Carousel'),
                ],
                [
                    'name' => Str::slug('Create News'),
                ],
                [
                    'name' => Str::slug('Edit News'),
                ],
                [
                    'name' => Str::slug('View News'),
                ],
                [
                    'name' => Str::slug('Delete News'),
                ],
                [
                    'name' => Str::slug('Create Vision'),
                ],
                [
                    'name' => Str::slug('Edit Vision'),
                ],
                [
                    'name' => Str::slug('View Vision'),
                ],
                [
                    'name' => Str::slug('Delete Vision'),
                ],
                [
                    'name' => Str::slug('Create History'),
                ],
                [
                    'name' => Str::slug('Edit History'),
                ],
                [
                    'name' => Str::slug('View History'),
                ],
                [
                    'name' => Str::slug('Delete History'),
                ],
                [
                    'name' => Str::slug('Create Organization'),
                ],
                [
                    'name' => Str::slug('Edit Organization'),
                ],
                [
                    'name' => Str::slug('View Organization'),
                ],
                [
                    'name' => Str::slug('Delete Organization'),
                ],
            );
            foreach($permissions AS $e){
                Permission::create([
                    'name' => $e['name'],
                ]);
            }
            // $permission = Permission::pluck('id','id')->all();
            $su = Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
            $user = \App\Models\Civitas\User::where('id',1)->first();
            // $su->syncPermissions($permission);
            $user->assignRole($su);
            // $dekan = Role::create(['name' => 'Dekan'])->givePermissionTo(
            //     [
            //         Str::slug('Dashboard'),
            //     ]
            // );
            $dekan = Role::create(['name' => 'Dekan']);
            $user2 = \App\Models\Civitas\User::where('id',2)->first();
            $user2->assignRole($dekan);

            $kaprodi = Role::create(['name' => 'KA Prodi']);
            $user3 = \App\Models\Civitas\User::where('id',3)->first();
            $user3->assignRole($kaprodi);

            $dosen = Role::create(['name' => 'Dosen']);
            $user4 = \App\Models\Civitas\User::where('id',4)->first();
            $user4->assignRole($dosen);

            $staf = Role::create(['name' => 'Staf']);
            $user5 = \App\Models\Civitas\User::where('id',5)->first();
            $user5->assignRole($staf);

            $himpunan = Role::create(['name' => 'Himpunan']);
            $user6 = \App\Models\Civitas\User::where('id',6)->first();
            $user6->assignRole($himpunan);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
