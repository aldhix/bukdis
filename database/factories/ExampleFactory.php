<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $i = rand(0,1);
        $gender = $i ? 'female': 'male';
        return [
            'name'=>$this->faker->name($gender),
            'gender'=>$gender,
            'address'=>$this->faker->address(),
        ];
    }
}
