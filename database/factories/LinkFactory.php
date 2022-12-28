<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Domain\Entities\Link;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'id' => Link::factory(),
            'short_url' => "deva",
            'long_url' => "https://deva.com.br",
            'expires' => '2023-12-31 23:00:00',
        ];
    }

}
