<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use Laravel\Sanctum\Sanctum;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
        // https://stackoverflow.com/questions/63219282/
        // $response->assertStatus(401);
    }
}
