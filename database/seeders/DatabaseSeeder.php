<?php

namespace Database\Seeders;

<<<<<<< HEAD

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> degustacao
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD


        $this->call([
            // Outros seeders se houver
           
        ]);

        $this->call(CargosSeeder::class);
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> degustacao
    }
}
