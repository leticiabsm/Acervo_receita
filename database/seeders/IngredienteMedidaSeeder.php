<?php

// database/seeders/IngredienteMedidaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediente;
use App\Models\Medida;

class IngredienteMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farinha = Ingrediente::firstOrCreate(
            ['nome' => 'Farinha de Trigo'],
            ['descricao' => 'Farinha branca comum']
        );

        $xicara = Medida::firstOrCreate(
            ['tipo' => 'Xícara', 'item' => '240ml'],
            ['descricao' => 'Unidade de volume']
        );

        $gramas = Medida::firstOrCreate(
            ['tipo' => 'Gramas', 'item' => 'Padrão'],
            ['descricao' => 'Unidade de peso']
        );

        // **ALTERAÇÃO AQUI:** Especifique a tabela para idMedida na cláusula where
        if (!$farinha->medidas()->wherePivot('idMedida', $xicara->idMedida)->exists()) {
            $farinha->medidas()->attach($xicara->idMedida, ['quantidade' => 2, 'observacao' => 'rasas']);
            $this->command->info('Anexada 2 xícaras de Farinha.');
        } else {
            $this->command->info('Relação Farinha-Xícara já existe. Pulando.');
        }

        // **ALTERAÇÃO AQUI:** Especifique a tabela para idMedida na cláusula where
        if (!$farinha->medidas()->wherePivot('idMedida', $gramas->idMedida)->exists()) {
             $farinha->medidas()->attach($gramas->idMedida, ['quantidade' => 500, 'observacao' => '']);
             $this->command->info('Anexada 500 gramas de Farinha.');
        } else {
            $this->command->info('Relação Farinha-Gramas já existe. Pulando.');
        }

        $this->command->info('Ingredientes e Medidas relacionados com sucesso!');
    }
}