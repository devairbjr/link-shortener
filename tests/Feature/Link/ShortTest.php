<?php

namespace Tests\Feature\Link;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortTest extends TestCase
{

    public function testRequestErrorRequired()
    {
        $data = [
            "long_urlll" => "https://testedeva.com",
        ];

        $this->json('POST', 'api/link/short', $data, ['Accept' => 'application/json'])
            ->assertStatus(409)
            ->assertJson([
                "errors" => [
                    "long_url" => ["validation.required"]
                ]
            ]);
    }
    public function testRequestErrorUrl()
    {
        $data = [
            "long_url" => "devair",
        ];

        $this->json('POST', 'api/link/short', $data, ['Accept' => 'application/json'])
            ->assertStatus(409)
            ->assertJson([
                "errors" => [
                    "long_url" => ["validation.url"]
                ]
            ]);
    }
}
