<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        // DB::table('permissions')->insert([
        //     [
        //         'tag' => 'admin',
        //         'module' => json_encode([
        //             'home' => [
        //                 'read' => true,
        //                 'write' => true,
        //                 'edit' => true,
        //                 'delete' => true,
        //             ],
        //             'config' => [
        //                 'read' => true,
        //                 'write' => true,
        //                 'edit' => true,
        //                 'delete' => true,
        //             ],
        //         ]),
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'tag' => 'dev',
        //         'module' => json_encode([
        //             'home' => [
        //                 'read' => true,
        //                 'write' => true,
        //                 'edit' => true,
        //                 'delete' => true,
        //             ],
        //         ]),
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'tag' => 'visitant',
        //         'module' => json_encode([
        //             'user' => [
        //                 'read' => false,
        //                 'write' => false,
        //                 'edit' => false,
        //                 'delete' => false,
        //             ],
        //         ]),
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        // ]);
    }
}
