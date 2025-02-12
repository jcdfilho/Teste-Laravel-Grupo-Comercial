<?php

namespace Tests\Feature;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BandeiraTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_bandeira()
    {
        $grupo = GrupoEconomico::factory()->create();
        
        $data = [
            'nome' => 'Bandeira Teste',
            'grupo_economico_id' => $grupo->id,
        ];

        $response = $this->postJson(route('bandeiras.store'), $data);

        $response->assertStatus(201)
                 ->assertJson(['nome' => 'Bandeira Teste']);

        $this->assertDatabaseHas('bandeiras', ['nome' => 'Bandeira Teste']);
    }

    public function test_leitura_bandeira()
    {
        $bandeira = Bandeira::factory()->create();

        $response = $this->getJson(route('bandeiras.show', $bandeira->id));

        $response->assertStatus(200)
                 ->assertJson(['nome' => $bandeira->nome]);
    }

    public function test_atualizar_bandeira()
    {
        $bandeira = Bandeira::factory()->create();

        $response = $this->putJson(route('bandeiras.update', $bandeira->id), [
            'nome' => 'Novo Nome Bandeira'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('bandeiras', ['nome' => 'Novo Nome Bandeira']);
    }

    public function test_deletar_bandeira()
    {
        $bandeira = Bandeira::factory()->create();

        $response = $this->deleteJson(route('bandeiras.destroy', $bandeira->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('bandeiras', ['id' => $bandeira->id]);
    }
}
