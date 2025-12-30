<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::factory()->count(100)->create();

        // Pass Students Only
        // Student::factory()->state([
        //     'mark' => 75,
        //     'result' => 'Pass'
        // ])->count(10)->create();
        // Fail Students Only
        // Student::factory()->state([
        //     'mark' => 20,
        //     'result' => 'Fail'
        // ])->count(10)->create();
    }
}
