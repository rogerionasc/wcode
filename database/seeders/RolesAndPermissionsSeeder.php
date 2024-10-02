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
        $permissions = [
            ['name' => 'write user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'read user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'update user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'delete user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'write finance', 'guard_name' => 'sanctum', 'category' => 'Financeiro'],
            ['name' => 'read finance', 'guard_name' => 'sanctum', 'category' => 'Financeiro'],
            ['name' => 'update finance', 'guard_name' => 'sanctum', 'category' => 'Financeiro'],
            ['name' => 'delete finance', 'guard_name' => 'sanctum', 'category' => 'Financeiro'],
        ];
        
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        // Permission::create(['name' => 'view dashboard', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'manage users', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'edit user', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'delete user', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'create user', 'guard_name' => 'sanctum']);
        // Permission::create(['name' => 'view reports']);

        // Criar roles e atribuir permissões
        $adminRole = Role::create(['name' => 'Administrador', 'guard_name' => 'sanctum']);
        $adminRole->givePermissionTo([
            'read user',
            'write user',
            'update user',
            'delete user',
            'read finance',
            'write finance',
            'update finance',
            'delete finance',
        ]);

        $manegeRole = Role::create(['name' => 'Gerente', 'guard_name' => 'sanctum']);
        $manegeRole->givePermissionTo([
            'read user',
            'write user',
            'update user',
            'update finance',
            'delete finance',
        ]);

        $memberRole = Role::create(['name' => 'Membro', 'guard_name' => 'sanctum']);
        // $memberRole->givePermissionTo(['view dashboard', 'update user']);
    
    }
}