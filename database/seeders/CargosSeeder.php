<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    public function run()
    {
        $cargos = [
            ['nome' => 'ADM', 'ativo' => true],
            ['nome' => 'Cozinheiro', 'ativo' => true],
            ['nome' => 'Degustador', 'ativo' => true],
            ['nome' => 'Editor', 'ativo' => true],
        ];

        foreach ($cargos as $cargo) {
            DB::table('cargos')->updateOrInsert(
                ['nome' => $cargo['nome']], // evita duplicatas
                ['ativo' => $cargo['ativo']]
            );
        }
    }
}
