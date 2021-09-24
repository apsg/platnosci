<?php
namespace Database\Factories;

use App\Domains\Payments\Models\PaymentRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'         => $this->faker->name(),
            'email'        => $this->faker->email(),
            'description'  => $this->faker->sentence(4),
            'amount'       => $this->faker->randomFloat(2, 1, 2000),
            'confirmed_at' => $this->faker->boolean(20) ? $this->faker->date('Y-m-d', 'now') : null,
            'rules_url'    => $this->faker->url(),
        ];
    }
}
