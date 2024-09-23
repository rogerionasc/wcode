<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões
        Permission::create(['name' => 'view dashboard', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'manage users', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'edit user', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'delete user', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'create user', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'view reports']);

        // Criar roles e atribuir permissões
        $adminRole = Role::create(['name' => 'Administrador', 'guard_name' => 'sanctum']);
        $adminRole->givePermissionTo(['view dashboard', 'manage users']);

        $manegeRole = Role::create(['name' => 'Gerente', 'guard_name' => 'sanctum']);
        $manegeRole->givePermissionTo(['view dashboard', 'create user', 'edit user', 'delete user']);

        $memberRole = Role::create(['name' => 'Membro', 'guard_name' => 'sanctum']);
        $memberRole->givePermissionTo(['view dashboard', 'create user']);
    
    }
}
