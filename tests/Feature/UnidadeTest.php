<?php

namespace Tests\Feature;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnidadeTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_unidade()
    {
        $bandeira = Bandeira::factory()->create();

        $data = [
            'nome_fantasia' => 'Unidade Teste',
            'razao_social' => 'Unidade Teste Ltda',
            'cnpj' => '12.345.678/0001-90',
            'bandeira_id' => $bandeira->id,
        ];

        $response = $this->postJson(route('unidades.store'), $data);

        $response->assertStatus(201)
                 ->assertJson(['nome_fantasia' => 'Unidade Teste']);

        $this->assertDatabaseHas('unidades', ['nome_fantasia' => 'Unidade Teste']);
    }

    public function test_leitura_unidade()
    {
        $unidade = Unidade::factory()->create();

        $response = $this->getJson(route('unidades.show', $unidade->id));

        $response->assertStatus(200)
                 ->assertJson(['nome_fantasia' => $unidade->nome_fantasia]);
    }

    public function test_atualizar_unidade()
    {
        $unidade = Unidade::factory()->create();

        $response = $this->putJson(route('unidades.update', $unidade->id), [
            'nome_fantasia' => 'Novo Nome Unidade'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('unidades', ['nome_fantasia' => 'Novo Nome Unidade']);
    }

    public function test_deletar_unidade()
    {
        $unidade = Unidade::factory()->create();

        $response = $this->deleteJson(route('unidades.destroy', $unidade->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('unidades', ['id' => $unidade->id]);
    }
}
