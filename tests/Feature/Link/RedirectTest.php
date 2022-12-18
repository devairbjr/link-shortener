<?php

namespace Tests\Feature\Link;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{

    public function testErrorLinkNotFound1()
    {
        $this->json('GET', 'api/link/redirect')->assertStatus(404);
    }
    public function testErrorLinkNotFound2()
    {
        $this->json('GET', 'api/link/redirect/devair')->assertStatus(409)
        ->assertJson([
            "errors" => "Link not found"
        ]);
    }

}
