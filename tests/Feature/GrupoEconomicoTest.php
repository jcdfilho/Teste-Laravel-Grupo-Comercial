<?php

namespace Tests\Feature;

use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GrupoEconomicoTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_grupo_economico()
    {
        $data = [
            'nome' => 'Grupo Teste',
        ];

        $response = $this->postJson(route('grupos-economicos.store'), $data);

        $response->assertStatus(201)
                 ->assertJson(['nome' => 'Grupo Teste']);

        $this->assertDatabaseHas('grupos_economicos', ['nome' => 'Grupo Teste']);
    }

    public function test_leitura_grupo_economico()
    {
        $grupo = GrupoEconomico::factory()->create();

        $response = $this->getJson(route('grupos-economicos.show', $grupo->id));

        $response->assertStatus(200)
                 ->assertJson(['nome' => $grupo->nome]);
    }

    public function test_atualizar_grupo_economico()
    {
        $grupo = GrupoEconomico::factory()->create();

        $response = $this->putJson(route('grupos-economicos.update', $grupo->id), [
            'nome' => 'Novo Nome'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('grupos_economicos', ['nome' => 'Novo Nome']);
    }

    public function test_deletar_grupo_economico()
    {
        $grupo = GrupoEconomico::factory()->create();

        $response = $this->deleteJson(route('grupos-economicos.destroy', $grupo->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('grupos_economicos', ['id' => $grupo->id]);
    }
}