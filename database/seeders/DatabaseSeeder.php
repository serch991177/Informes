<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@cochabamba.com',
            'password' => ('secret'),
           'id_oficina'=>'0',
            'apellido_paterno'=>'admin',
            'apellido_materno'=>'admin',
            'carnet'=>'11111',
            'celular'=>'77777777',
            'telefono'=>'4444444',
            'cargo'=>'administrador',
            'unidad'=>'alcaldia',
            'estado'=>'activo',
            'generador'=>'true',
            'revisor'=>'true',
            'finalizador'=>'true',
        ]);
    }
}
