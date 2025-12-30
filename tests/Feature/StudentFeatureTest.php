<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function student_can_be_created()
    {
        $response = $this->postJson('/students', [
            'name' => 'Gourav Choudhary',
            'age'  => 22,
            'mark' => 75,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('students', [
            'name'   => 'Gourav Choudhary',
            'result' => 'Pass',
        ]);
    }

    /** @test */
    public function validation_fails_when_required_fields_are_missing()
    {
        $response = $this->postJson('/students', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'age', 'mark']);
    }

    /** @test */
    public function student_result_is_fail_when_mark_is_below_40()
    {
        $this->postJson('/students', [
            'name' => 'Joni',
            'age'  => 20,
            'mark' => 30,
        ]);

        $this->assertDatabaseHas('students', [
            'name'   => 'Kala',
            'result' => 'Fail',
        ]);
    }

    /** @test */
    public function student_can_be_updated()
    {
        $student = Student::factory()->create([
            'mark' => 30,
            'result' => 'Fail',
        ]);

        $response = $this->putJson("/students/{$student->id}", [
            'name' => 'Gourav',
            'age'  => 25,
            'mark' => 85,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('students', [
            'id'     => $student->id,
            'result' => 'Pass',
        ]);
    }

    /** @test */
    public function student_can_be_deleted()
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson("/students/{$student->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id
        ]);
    }

    /** @test */
    public function students_can_be_sorted_by_mark()
    {
        Student::factory()->create(['mark' => 20]);
        Student::factory()->create(['mark' => 90]);

        $response = $this->get('/students-list?sort=mark&direction=desc');

        $response->assertStatus(200);
        $response->assertSee('90');
    }

    /** @test */
    public function students_can_be_searched_by_name()
    {
        Student::factory()->create(['name' => 'Gourav']);
        Student::factory()->create(['name' => 'Choudhary']);

        $response = $this->get('/students-list?search=Gourav');

        $response->assertStatus(200);
        $response->assertSee('Gourav')
                 ->assertDontSee('Choudahry');
    }

    /** @test */
    public function students_are_paginated()
    {
        Student::factory()->count(20)->create();

        $response = $this->get('/students-list');

        $response->assertStatus(200);
        $response->assertSee('Next');
    }
}
