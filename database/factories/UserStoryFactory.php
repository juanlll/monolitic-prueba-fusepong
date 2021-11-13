<?php

namespace Database\Factories;

use App\Models\UserStory;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserStoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserStory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'project_id' => $this->faker->randomDigitNotNull,
        'as_a' => $this->faker->word,
        'so_that' => $this->faker->word,
        'i_want' => $this->faker->word,
        'acceptance_criteria' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
