<?php
namespace Database\Factories;

use App\Domains\Actions\Jobs\AccessJob;
use App\Domains\Actions\Models\Action;
use App\Domains\Sales\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ActionFactory extends Factory
{
    protected $model = Action::class;

    public function definition()
    {
        return [
            'sale_id'    => Sale::factory(),
            'type'       => Arr::random([Action::TYPE_FAIL, Action::TYPE_SUCCESS]),
            'job'        => AccessJob::class,
            'parameters' => [
                'provider'  => Arr::random(array_keys(config('integrations.access.providers'))),
                'course_id' => $this->faker->numberBetween(1, 100),
            ],
        ];
    }
}
