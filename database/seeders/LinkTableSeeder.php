<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Entities\Link;
use Carbon\Carbon;

class LinkTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            "long_url" => "https://google.com.br",
            "short_url" => "google",
            "expires_at" => Carbon::now()->addDays(365),
        ]);
    }
}
