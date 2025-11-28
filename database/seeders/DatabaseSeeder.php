<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un usuario administrador manualmente
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@appbook.com',
            'password' => Hash::make('12345678'),
        ]);
    
        // Crear 5 usuarios normales con datos falsos
        User::factory(5)->create();

        // Crear 20 libros aleatorios
        Book::factory(20)->create();

        $user->is_admin = true;
        $user->save();

    }
}
