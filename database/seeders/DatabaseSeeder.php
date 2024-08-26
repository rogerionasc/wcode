<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Account;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'first_name' => 'Rogério',
            'last_name' => 'Nascimento',
            'document' => '38041715087',
            'email' => 'rogerio@example.com',
            'role' => 'admin',
            'password' => 'roger@2014',

        ]);

        $account = Account::factory()->create([
            'user_id' => $user->id,
            'owner' => true,
        ]);

        $this->call(RolesTableSeeder::class);

        $this->call(PermissionSeeder::class);
    }
}
