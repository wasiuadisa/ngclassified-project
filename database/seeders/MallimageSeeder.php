<?php

namespace Database\Seeders;

use App\Models\Mallimage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MallimageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mallimage::factory()->times(1000)->create();
    }
}
