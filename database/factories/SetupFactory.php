<?php

namespace Database\Factories;

use App\Models\Setup;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_url' => $this->faker->url(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->address(),
            'about' => $this->faker->sentence(200),
            'logo' => 'http://lorempixel.com/300/100/nature/'.rand(1, 9).'/'
        ];
    }
}
