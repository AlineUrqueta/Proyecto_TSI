<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $usuario = new Usuario;
        $usuario->nom_usuario = 'Administrador' ;
        $usuario->apep_usuario = 'Centro';
        $usuario->apem_usuario = 'Médico';
        $usuario->fono = '999999999';
        $usuario->email = 'admin@centromedico.cl';
        $usuario->password = Hash::make('12345678');
        $usuario->id_tipo = 1;
        $usuario->save();

    }
}
