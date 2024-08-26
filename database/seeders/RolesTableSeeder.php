<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Inserindo dados na tabela 'roles'
        DB::table('roles')->insert([
            ['tag_permission' => 'admin', 'title' => 'Administrador', 'created_at' => $now, 'updated_at' => $now],
            ['tag_permission' => 'dev', 'title' => 'Desenvolvedor', 'created_at' => $now, 'updated_at' => $now],
            ['tag_permission' => 'manager', 'title' => 'Gerente', 'created_at' => $now, 'updated_at' => $now],
            ['tag_permission' => 'visitant', 'title' => 'Visitante', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
