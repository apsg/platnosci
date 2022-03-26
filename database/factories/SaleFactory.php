<?php
namespace Database\Factories;

use App\Domains\Sales\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'rules_url'   => $this->faker->url(),
            'price'       => $this->faker->numberBetween(10, 20),
            'full_price'  => $this->faker->boolean() ? $this->faker->numberBetween(21, 30) : null,
        ];
    }

    public function modelName()
    {
        return Sale::class;
    }
}
