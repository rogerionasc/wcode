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
        $this->call(RolesAndPermissionsSeeder::class);

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

        // Atribui o papel "Administrador" ao usuário
        $user->syncRoles('Administrador');

        // Cria uma conta associada ao usuário específico
        Account::factory()->create([
            'user_id' => $user->id,
            'owner' => true,
            'status' => 'active',
        ]);

        // Cria um endereço associado ao usuário específico
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

        User::factory(5)->create()->each(function ($user) {
            // Atribui um papel padrão aos usuários (se necessário)
            $user->syncRoles('Membro');

            // Cria uma conta associada a cada usuário
            Account::factory()->create([
                'user_id' => $user->id,
                'owner' => false,
                'status' => 'active',
            ]);

            // Cria um endereço para cada usuário
            Address::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
