<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'sku' => Str::upper(fake()->uuid),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            if (! $product->family_id) {
                $family = Family::factory()->create();
                $product->family_id = $family->id;
                $product->save();
                $product->setRelation('family', $family);
                $family->setRelation('product', $product);
            }
        })->afterCreating(function (Product $product) {

        });
    }
}
