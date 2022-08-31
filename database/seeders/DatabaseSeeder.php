<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Oportunidade;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // root
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@vitaminaweb.com.br',
            'password' => Hash::make("vitaminaweb"),
            'root' => true,
        ]);

        // criar vendedores
        User::create([
            'name' => 'Rick Sanchez',
            'email' => 'rick@sanchez.com',
            'password' => Hash::make('80085')
        ]);
        
        User::create([
            'name' => 'Morty',
            'email' => 'morty@hotmiau.com',
            'password' => Hash::make('jessica')
        ]);

        // produtos
        Produto::create([
            'nome' => 'Propulsor Galático',
            'user_id' => 1,
        ]);

        Produto::create([
            'nome' => 'Portal Interdimensional',
            'user_id' => 1,
        ]);
        
        Produto::create([
            'nome' => 'Chiclete',
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Pack de Figurinhas',
            'user_id' => 2,
        ]);

        // clientes

        Cliente::create([
            'nome' => 'Jeff',
            'user_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'BirdPerson',
            'user_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'Mr. Poopybutthole',
            'user_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'Planetina',
            'user_id' => 2,
        ]);

        Cliente::create([
            'nome' => 'Squanchy',
            'user_id' => 2,
        ]);

        // Oportunidades

        // Rick > BirdPerson > Propulsor
        Oportunidade::create([
            'user_id' => 1,
            'cliente_id' => 2,
            'produto_id' => 1,
        ]);

        // Morty > Squanchy > Pack de Figurinhas
        Oportunidade::create([
            'user_id' => 2,
            'cliente_id' => 5,
            'produto_id' => 4,
        ]);


    }
}
