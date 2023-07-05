<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'make' => $this->faker->company,
            'model' => $this->faker->word,
            'registration' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{2} [A-Z]{3}'),
        ];
    }
}
