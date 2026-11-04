<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        if (Rating::query()->exists()) {
            return;
        }

        Rating::factory()->count(8)->create();
        Rating::factory()->hidden()->count(1)->create();
    }
}
