<?php

namespace Database\Seeders;

<<<<<<< HEAD


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

>>>>>>> 67dfb4b630a576f1e22302d877c3f24abb08e720

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
=======


>>>>>>> 67dfb4b630a576f1e22302d877c3f24abb08e720

        $this->call([
            // Outros seeders se houver
           
        ]);

        $this->call(CargosSeeder::class);

    }
}
