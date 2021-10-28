<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    /**
     * Test get success all lessons by module
     *
     * @return void
     */
    public function test_get_all_lessons_by_module()
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons");

        $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    /**
     * Test get notfound lessons by module
     *
     * @return void
     */
    public function test_get_notfound_lessons_by_module()
    {
        $response = $this->getJson('/modules/fake_value/lessons');

        $response->assertStatus(404);
    }

    /**
     * Test get success all lesson by module
     *
     * @return void
     */
    public function test_get_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Test validation create unprocessable entity lesson by module
     *
     * @return void
     */
    public function test_validation_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", []);

        $response->assertStatus(422);
    }

    /**
     * Test create success lesson by module
     *
     * @return void
     */
    public function test_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", [
            'module' => $module->uuid,
            'name' => 'Aula 01',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test validation update unprocessable entity lesson by module
     *
     * @return void
     */
    public function test_validation_update_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * Test update success lesson by module
     *
     * @return void
     */
    public function test_update_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", [
            'module' => $module->uuid,
            'name' => 'Aula Updated',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test delete notfound lesson by module
     *
     * @return void
     */
    public function test_delete_notfound_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/fake_value");

        $response->assertStatus(404);
    }

    /**
     * Test delete success lesson by module
     *
     * @return void
     */
    public function test_delete_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(204);
    }
}
