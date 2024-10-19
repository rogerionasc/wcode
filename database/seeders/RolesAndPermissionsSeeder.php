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
            //Usuário
            ['name' => 'write user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'read user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'update user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            ['name' => 'delete user', 'guard_name' => 'sanctum', 'category' => 'Usuário'],
            //Paciente
            ['name' => 'write patient', 'guard_name' => 'sanctum', 'category' => 'Paciente'],
            ['name' => 'read patient', 'guard_name' => 'sanctum', 'category' => 'Paciente'],
            ['name' => 'update patient', 'guard_name' => 'sanctum', 'category' => 'Paciente'],
            ['name' => 'delete patient', 'guard_name' => 'sanctum', 'category' => 'Paciente'],
        ];
        
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Criar roles e atribuir permissões
        $adminRole = Role::create(['name' => 'Administrador', 'guard_name' => 'sanctum']);
        $adminRole->givePermissionTo([
            'read user',
            'write user',
            'update user',
            'delete user',
            'read patient',
            'write patient',
            'update patient',
            'delete patient',
        ]);

        $manegeRole = Role::create(['name' => 'Gerente', 'guard_name' => 'sanctum']);
        $manegeRole->givePermissionTo([
            'read user',
            'write user',
            'update user',
            'delete user',
            'read patient',
            'write patient',
            'update patient',
            'delete patient',
        ]);

        $seoRole = Role::create(['name' => 'SEO', 'guard_name' => 'sanctum']);
        $seoRole->givePermissionTo([
            'read user',
            'write user',
            'update user',
            'delete user',
            'read patient',
            'write patient',
            'update patient',
            'delete patient',
        ]);

        $memberRole = Role::create(['name' => 'Membro', 'guard_name' => 'sanctum']);
        $memberRole = Role::create(['name' => 'Recepcionista', 'guard_name' => 'sanctum']);
        // $memberRole->givePermissionTo(['view dashboard', 'update user']);
    
    }
}
