<?php

namespace Database\Factories;

use App\Models\Transfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transfer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_number_from' => $this->faker->unique()->number(20),
            'account_number_to' => $this->faker->unique()->number(20),
            'full_name' => $this->faker->name(),
            'amount' => $this->faker->amount(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
