<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_game_can_be_added_to_db_without_image()
    {
        $response = $this->post('api/games/', [
            'title' => 'my title',
            'description' => 'fun game'
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertCount(1, Game::all());
    }

    public function test_a_game_cannot_be_added_without_a_title()
    {
        $response = $this->post('api/games/', [
            'title' => '',
            'description' => 'fun game'
        ]);
        $response->assertSessionHasErrors('title');
    }

    public function test_a_game_cannot_be_added_without_a_description()
    {
        $response = $this->post('api/games/', [
            'title' => 'my title',
            'description' => ''
        ]);
        $response->assertSessionHasErrors('description');
    }
}
