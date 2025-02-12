<?php

namespace Tests\Feature\Livewire\Group;

use App\Livewire\Group\Index;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Index::class)
            ->assertStatus(200);
    }
}
