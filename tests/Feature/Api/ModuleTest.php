<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * Test get success all modules by course
     *
     * @return void
     */
    public function test_get_all_modules_by_course()
    {
        $course = Course::factory()->create();

        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->uuid}/modules");

        $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    /**
     * Test get notfound modules by course
     *
     * @return void
     */
    public function test_get_notfound_modules_by_course()
    {
        $response = $this->getJson('/courses/fake_value/modules');

        $response->assertStatus(404);
    }

    /**
     * Test get success all module by course
     *
     * @return void
     */
    public function test_get_module_by_course()
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Test validation create unprocessable entity module by course
     *
     * @return void
     */
    public function test_validation_create_module_by_course()
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->uuid}/modules", []);

        $response->assertStatus(422);
    }

    /**
     * Test create success module by course
     *
     * @return void
     */
    public function test_create_module_by_course()
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->uuid}/modules", [
            'course' => $course->uuid,
            'name' => 'Módulo 01',
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test validation update unprocessable entity module by course
     *
     * @return void
     */
    public function test_validation_update_module_by_course()
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create();

        $response = $this->putJson("/courses/{$course->uuid}/modules/{$module->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * Test update success module by course
     *
     * @return void
     */
    public function test_update_module_by_course()
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create();

        $response = $this->putJson("/courses/{$course->uuid}/modules/{$module->uuid}", [
            'course' => $course->uuid,
            'name' => 'Módulo 01',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test delete notfound module by course
     *
     * @return void
     */
    public function test_delete_notfound_module_by_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/courses/{$course->uuid}/modules/fake_value");

        $response->assertStatus(404);
    }

    /**
     * Test delete success module by course
     *
     * @return void
     */
    public function test_delete_module_by_course()
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create();

        $response = $this->deleteJson("/courses/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(204);
    }
}
