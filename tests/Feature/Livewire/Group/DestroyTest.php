<?php

namespace Tests\Feature\Livewire\Group;

use App\Livewire\Group\Destroy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Destroy::class)
            ->assertStatus(200);
    }
}
