<?php

namespace Database\Seeders;

use App\Models\Mallpost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MallpostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mallpost::factory()->times(700)->create();
    }
}
