<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['white', 'black', 'silver', 'gold'];

        return [
            'title' => Str::ucfirst(fake()->unique()->words(6, true)),
            'short_description' => fake()->text(200),
            'full_description' => fake()->text(500),
            'price' => fake()->numberBetween(300, 500),
            'quantity' => 50,
            'image_path' => '/images/products/',
            'image_name' => $this->randomImage(),
            'category' => $categories[fake()->numberBetween(0, sizeof($categories) - 1)],
            'classification' => 'default',
            'created_at' => fake()->dateTimeBetween(now()->subMonths(3), now()),
        ];
    }


    public function randomImage()
    {
        // Custom disk: config/filesystems.php - images
        // load images
        $images = Storage::disk('images')->files();

        if (empty($images)) {
            return 'no_image.jpg';
        }

        // Select a random index from the array
        $randomIndex = array_rand($images);

        // Retrieve the value corresponding to the random index
        $randomValue = $images[$randomIndex];

        return $randomValue;
    }
}
