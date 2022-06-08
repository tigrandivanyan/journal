<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
//      route testing
        $response = $this->get('/show-one-entry/191691');
        $response->assertStatus(200);



        $this->assertDatabaseHas('entries', [
            'id' => 191691,
        ]);
    }
}
