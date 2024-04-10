<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'blogs.all']);
        Permission::create(['name' => 'blogs']);
        Permission::create(['name' => 'authors']);
        Permission::create(['name' => 'messages']);

        $admin = Role::create(['name'=>'Administrator']);
        $admin->syncPermissions(['users', 'blogs.all', 'authors', 'messages' ]);

        $contributor = Role::create(['name'=>'Contributor']);
        $contributor->syncPermissions(['blogs']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles_data');
    }
};
