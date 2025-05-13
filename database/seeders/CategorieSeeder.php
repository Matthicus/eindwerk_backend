<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categories;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        categories::factory(10)->create();
    }
}
