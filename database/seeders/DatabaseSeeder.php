<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria um usuário específico com informações fornecidas
        $user = User::factory()->create([
            'first_name' => 'Rogério',
            'last_name' => 'Nascimento',
            'document' => '380.417.150-87',
            'email' => 'rogerio@example.com',
            'birth_date' => '1993-02-06',
            'role' => 'Administrador',
            'password' => \Illuminate\Support\Facades\Hash::make('roger@2014'),
        ]);

        // Cria uma conta associada ao usuário específico
        Account::factory()->create([
            'user_id' => $user->id,
            'owner' => true,
            'status' => 'active',
        ]);

        Address::factory()->create([
            'user_id' => $user->id,
            'post_code' => '59149110',
            'street' => 'Rio Ipojuca',
            'number' => '29',
            'neighborhood' => 'Parque Industrial',
            'city' => 'Parnamirim',
            'state' => 'RN',
            'complement' => 'Club CPSERN'
        ]);

        // Cria 9 usuários adicionais aleatórios e suas contas
        User::factory(5)->create()->each(function ($user) {
            Account::factory()->create([
                'user_id' => $user->id,
                'owner' => false, // Defina o valor conforme necessário
                'status' => 'active',
            ]);
            Address::factory()->create([
                'user_id' => $user->id,
            ]);
        });

        $this->call(RolesAndPermissionsSeeder::class);

        // Chama outros seeders, se necessário
        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionSeeder::class);
    }
}
