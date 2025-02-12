<?php

namespace Tests\Feature;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColaboradorTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_colaborador()
    {
        $unidade = Unidade::factory()->create();

        $data = [
            'nome' => 'Colaborador Teste',
            'email' => 'teste@teste.com',
            'cpf' => '123.456.789-10',
            'unidade_id' => $unidade->id,
        ];

        $response = $this->postJson(route('colaboradores.store'), $data);

        $response->assertStatus(201)
                 ->assertJson(['nome' => 'Colaborador Teste']);

        $this->assertDatabaseHas('colaboradores', ['nome' => 'Colaborador Teste']);
    }

    public function test_leitura_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $response = $this->getJson(route('colaboradores.show', $colaborador->id));

        $response->assertStatus(200)
                 ->assertJson(['nome' => $colaborador->nome]);
    }

    public function test_atualizar_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $response = $this->putJson(route('colaboradores.update', $colaborador->id), [
            'nome' => 'Novo Nome Colaborador'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('colaboradores', ['nome' => 'Novo Nome Colaborador']);
    }

    public function test_deletar_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $response = $this->deleteJson(route('colaboradores.destroy', $colaborador->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('colaboradores', ['id' => $colaborador->id]);
    }
}
