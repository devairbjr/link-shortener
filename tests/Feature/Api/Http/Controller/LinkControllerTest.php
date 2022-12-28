<?php

namespace Tests\Feature\Api\Http\Controller;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkControllerTest extends TestCase
{

    public function testRedirectLinkNotFound1()
    {
        $this->json('GET', 'api/link/redirect')->assertStatus(404);
    }
    public function testRedirectLinkNotFound2()
    {
        $this->json('GET', 'api/link/redirect/devair1')->assertStatus(409)
        ->assertJson([
            "errors" => "Link not found"
        ]);
    }

    public function testCreateLinkRequestErrorRequired()
    {
        $data = [
            "long_urlll" => "https://testedeva.com",
        ];

        $this->json('POST', 'api/link/short', $data, ['Accept' => 'application/json'])
            ->assertStatus(409)
            ->assertJson([
                "errors" => [
                    "long_url" => ["long_url is required"]
                ]
            ]);
    }
    public function testCreateLinkRequestErrorUrlInvalid()
    {
        $data = [
            "long_url" => "devair",
        ];

        $this->json('POST', 'api/link/short', $data, ['Accept' => 'application/json'])
            ->assertStatus(409)
            ->assertJson([
                "errors" => [
                    "long_url" => ["Invalid Url"]
                ]
            ]);
    }

}
