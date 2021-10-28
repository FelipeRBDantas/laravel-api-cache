<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * Test get success all courses.
     *
     * @return void
     */
    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(200);
    }

    /**
     * Test get success count courses.
     *
     * @return void
     */
    public function test_get_count_courses()
    {
        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses');

        $response->assertJsonCount(10, 'data');

        $response->assertStatus(200);
    }

    /**
     * Test get notfound course.
     *
     * @return void
     */
    public function test_get_notfound_course()
    {
        $response = $this->getJson('/courses/fake_value');

        $response->assertStatus(404);
    }

    /**
     * Test get success course.
     *
     * @return void
     */
    public function test_get_course()
    {
        $course =  Course::factory()->create();

        $response = $this->getJson("/courses/{$course->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Test validation create unprocessable entity course.
     *
     * @return void
     */
    public function test_validation_create_course()
    {
        $response = $this->postJson('/courses', []);

        $response->assertStatus(422);
    }

    /**
     * Test create success course.
     *
     * @return void
     */
    public function test_create_course()
    {
        $response = $this->postJson('/courses', [
            'name' => 'Novo Curso'
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test validation update unprocessable entity course.
     *
     * @return void
     */
    public function test_validation_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->identify}", []);

        $response->assertStatus(422);
    }

    /**
     * Test update success course.
     *
     * @return void
     */
    public function test_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/courses/{$course->uuid}", [
            'name' => 'Novo Updated'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test update notfound course.
     *
     * @return void
     */
    public function test_update_notfound_course()
    {
        $response = $this->putJson('/courses/fake_value', [
            'name' => 'Novo Updated'
        ]);

        $response->assertStatus(404);
    }

    
    /**
     * Test delete success course.
     *
     * @return void
     */
    public function test_delete_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/courses/{$course->uuid}");

        $response->assertStatus(204);
    }

    /**
     * Test delete notfound course.
     *
     * @return void
     */
    public function test_delete_notfound_course()
    {
        $response = $this->deleteJson('/courses/fake_value');

        $response->assertStatus(404);
    }
}
