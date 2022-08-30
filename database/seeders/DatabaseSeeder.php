<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Vendedor;
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
            'email' => 'admin@example.com',
            'password' => Hash::make("vitaminaweb")
        ]);

        // criar vendedores
        Vendedor::create([
            'nome' => 'Rick Sanchez',
            'email' => 'rick@sanchez.com',
            'password' => Hash::make('80085')
        ]);
        
        Vendedor::create([
            'nome' => 'Morty',
            'email' => 'morty@hotmiau.com',
            'password' => Hash::make('jessica')
        ]);

        // produtos
        Produto::create([
            'nome' => 'Propulsor Galático',
            'vendedor_id' => 1,
        ]);

        Produto::create([
            'nome' => 'Portal Interdimensional',
            'vendedor_id' => 1,
        ]);
        
        Produto::create([
            'nome' => 'Chiclete',
            'vendedor_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Pack de Figurinhas',
            'vendedor_id' => 2,
        ]);

        // clientes

        Cliente::create([
            'nome' => 'Jeff',
            'vendedor_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'BirdPerson',
            'vendedor_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'Mr. Poopybutthole',
            'vendedor_id' => 1,
        ]);

        Cliente::create([
            'nome' => 'Planetina',
            'vendedor_id' => 2,
        ]);

        Cliente::create([
            'nome' => 'Squanchy',
            'vendedor_id' => 2,
        ]);

        // Oportunidades

        // Rick > BirdPerson > Propulsor
        Oportunidade::create([
            'vendedor_id' => 1,
            'cliente_id' => 2,
            'produto_id' => 1,
        ]);

        // Morty > Squanchy > Pack de Figurinhas
        Oportunidade::create([
            'vendedor_id' => 2,
            'cliente_id' => 5,
            'produto_id' => 4,
        ]);


    }
}
