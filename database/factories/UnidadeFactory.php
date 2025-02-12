<?php

namespace Database\Factories;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidade>
 */
class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    public function definition()
    {
        return [
            'nome_fantasia' => $this->faker->company(),
            'razao_social' => $this->faker->company(),
            'cnpj' => $this->faker->unique()->randomNumber(9) . '0001', 
            'bandeira_id' => Bandeira::factory(),
        ];
    }
}
