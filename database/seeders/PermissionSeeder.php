<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('permissions')->insert([
            [
                'tag' => 'admin',
                'module' => 'geral',
                'read' => true,
                'write' => true,
                'edit' => true,
                'delete' => true,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tag' => 'receptionist',
                'module' => 'usuario',
                'read' => true,
                'write' => false,
                'edit' => false,
                'delete' => false,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);

    }
}
