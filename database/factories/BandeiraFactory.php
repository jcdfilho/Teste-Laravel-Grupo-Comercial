<?php

namespace Database\Factories;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bandeira>
 */
class BandeiraFactory extends Factory
{
    protected $model = Bandeira::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word(),
            'grupo_economico_id' => GrupoEconomico::factory(),
        ];
    }
}
