<?php

namespace Database\Factories;

use App\Models\Mallimage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MallimageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Image filename
        $image_filename = $this->faker->file($sourceDir = 'C:\xampp\htdocs\wasiuadisa.online\portfolio\ngclassified\storage\app\seeding_files\seeding_images', $targetDir = 'C:\xampp\htdocs\wasiuadisa.online\portfolio\ngclassified\storage\app\mall_images', false);

        return [
            'deleted' => 0,
            'blocked' => 0,
            'mallposts_id' => $this->faker->numberBetween(1, 700),
            'caption' => $this->faker->words($nb = $this->faker->numberBetween(2, 4), $asText = true),
            'filename' => $image_filename,
        ];
    }
}