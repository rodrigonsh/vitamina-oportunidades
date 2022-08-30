<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make("vitaminaweb")
        ]);

        // criar vendedores
        \App\Models\Vendedor::factory()->create([
            'nome' => 'Rick Sanchez',
            'email' => 'rick@sanchez.com',
            'password' => Hash::make('80085')
        ]);
        
        \App\Models\Vendedor::factory()->create([
            'nome' => 'Morty',
            'email' => 'morty@hotmiau.com',
            'password' => Hash::make('jessica')
        ]);

        // produtos
        \App\Models\Produto::factory()->create([
            'nome' => 'Propulsor Galático',
            'vendedor_id' => 1,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'Portal Interdimensional',
            'vendedor_id' => 1,
        ]);
        
        \App\Models\Produto::factory()->create([
            'nome' => 'Chiclete',
            'vendedor_id' => 2,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'Pack de Figurinhas',
            'vendedor_id' => 2,
        ]);

        // clientes

        \App\Models\Cliente::factory()->create([
            'nome' => 'Jeff',
            'vendedor_id' => 1,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'BirdPerson',
            'vendedor_id' => 1,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'Mr. Poopybutthole',
            'vendedor_id' => 1,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'Planetina',
            'vendedor_id' => 2,
        ]);

        \App\Models\Produto::factory()->create([
            'nome' => 'Squanchy',
            'vendedor_id' => 2,
        ]);

        // Oportunidades

        // Rick > BirdPerson > Propulsor
        \App\Models\Oportunidade::factory()->create([
            'vendedor_id' => 1,
            'cliente_id' => 2,
            'produto_id' => 1,
        ]);

        // Morty > Squanchy > Pack de Figurinhas
        \App\Models\Oportunidade::factory()->create([
            'vendedor_id' => 2,
            'cliente_id' => 5,
            'produto_id' => 4,
        ]);


    }
}
