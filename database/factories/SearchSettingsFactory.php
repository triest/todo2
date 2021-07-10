<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SearchSettings;

class SearchSettingsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = SearchSettings::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'target_array' => $this->faker->word,
            'meet' => $this->faker->word,
            'age_from' => $this->faker->randomNumber(),
            'age_to' => $this->faker->randomNumber(),
            'cookie' => $this->faker->word,
        ];
    }
}
