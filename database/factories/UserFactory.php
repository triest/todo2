<?php

namespace Database\Factories;

use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'settings' => $this->faker->word,
                'sex_id' => rand(1, 2),
                'unique_id' => $this->faker->word,
                'email_verified_at' => $this->faker->dateTime(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'photo_name' => $this->faker->word,
                'photo_url' => "https://via.placeholder.com/300/09f/fff.pngC/O%20https://placeholder.com/",
                'relation_id' => rand(1,3),
                'children_id'=>rand(1,3),
                 'alcohol_id'=>rand(1,3),
                'smoking_id'=>rand(1,4),
                'body_type_id'=>rand(1,4)
        ];
    }
}
