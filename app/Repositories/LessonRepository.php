<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $entity)
    {
        $this->entity = $entity;
    }
    
    public function getLessonsModule(int $moduleId)
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->get();        
    }
    
    public function createNewLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;

        return $this->entity->create($data);
    }
    
    public function getLessonByModule(int $moduleId, string $identify)
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->where('uuid', $identify)
            ->firstOrFail();
    }
    
    public function getLessonByUuid(string $identify)
    {
        return $this->entity
            ->where('uuid', $identify)
            ->firstOrFail();
    }
    
    public function updateLessonByUuid(int $moduleId, string $identify, array $data)
    {
        $module = $this->getLessonByUuid($identify);

        $data['module_id'] = $moduleId;

        Cache::forget('courses');

        return $module->update($data);
    }
    
    public function deleteLessonByUuid(string $identify)
    {
        $module = $this->getLessonByUuid($identify);

        Cache::forget('courses');

        return $module->delete();
    }
}