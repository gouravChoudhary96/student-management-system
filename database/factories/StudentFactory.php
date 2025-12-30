<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $mark = $this->faker->numberBetween(0, 100);

        return [
            'name'   => $this->faker->name(),
            'age'    => $this->faker->numberBetween(18, 40),
            'mark'   => $mark,
            'result' => $mark >= 40 ? 'Pass' : 'Fail',
        ];
    }
}
