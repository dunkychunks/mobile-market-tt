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
        // Updated categories to match a Trinidadian Fresh Market context
        $categories = ['fruits', 'vegetables', 'root-crops', 'herbs'];

        return [
            // Generates a shorter, more realistic product name (e.g., "Fresh Organic Mango")
            'title' => Str::ucfirst(fake()->unique()->words(3, true)),
            'short_description' => fake()->sentence(10),
            'full_description' => fake()->paragraph(3),

            // Updated price range to be more realistic for local produce (e.g., $10 to $50)
            'price' => fake()->numberBetween(10, 50),

            'quantity' => fake()->numberBetween(10, 100),
            'image_path' => '/images/products/',
            'image_name' => $this->randomImage(), // Picks your new fruit filenames automatically
            'category' => $categories[fake()->numberBetween(0, count($categories) - 1)],
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
