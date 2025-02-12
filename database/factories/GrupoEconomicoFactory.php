<?php

namespace Database\Factories;

use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GrupoEconomico>
 */
class GrupoEconomicoFactory extends Factory
{
    protected $model = GrupoEconomico::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->company(),
        ];
    }
}
