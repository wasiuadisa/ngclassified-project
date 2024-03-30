<?php

namespace Database\Factories;

use App\Models\Mallpost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MallpostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $condition_array = array('new', 'used');
        $random_condition_number = array_rand($condition_array);
        $conditionChoice = $condition_array[$random_condition_number];

        // Image filename
        $image_filename = $this->faker->file($sourceDir = 'C:\xampp\htdocs\wasiuadisa.online\portfolio\ngclassified\storage\app\seeding_files\seeding_images', $targetDir = 'C:\xampp\htdocs\wasiuadisa.online\portfolio\ngclassified\storage\app\mall_images', false);
        $theTitle = $this->faker->words($nb = $this->faker->numberBetween(3, 8), $asText = true);

        $age_array = array(' years', ' months');
        $random_age_number = array_rand($age_array);
        $ageChoice = $age_array[$random_age_number];

        return [
            'deleted' => 0,
            'blocked' => 0,
            'mallcategories_id' => $this->faker->numberBetween(1, 8),
            'users_id' => $this->faker->numberBetween(1, 11),
            'title' => $theTitle,
            'description' => $this->faker->words($nb = $this->faker->numberBetween(50, 100), $asText = true),
            'price' => $this->faker->numberBetween(500, 20000),
            'age' => $this->faker->numberBetween(1, 10) . $ageChoice,
            'condition' => $conditionChoice,
            'state' => $this->faker->state($nb = 1, $asText = true),
            'city' => $this->faker->city($nb = 1, $asText = true),
            'contact_name' => $this->faker->name($nb = 1, $asText = true),
            'contact_address' => $this->faker->address($nb = 1, $asText = true),
            'contact_phone' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->safeEmail,
            'views' => $this->faker->numberBetween(5, 20000),
            'url_slug' => Str::slug($theTitle, '-'),
            'filename' => $image_filename,
        ];
    }
}
