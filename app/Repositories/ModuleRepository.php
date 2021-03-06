<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $entity)
    {
        $this->entity = $entity;
    }
    
    public function getModuleCourse(int $courseId)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->get();        
    }
    
    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        return $this->entity->create($data);
    }
    
    public function getModuleByCourse(int $courseId, string $identify)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->where('uuid', $identify)
            ->firstOrFail();
    }
    
    public function getModuleByUuid(string $identify)
    {
        return $this->entity
            ->where('uuid', $identify)
            ->firstOrFail();
    }
    
    public function updateModuleByUuid(int $courseId, string $identify, array $data)
    {
        $module = $this->getModuleByUuid($identify);

        $data['course_id'] = $courseId;

        Cache::forget('courses');

        return $module->update($data);
    }
    
    public function deleteCourseByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);

        Cache::forget('courses');

        return $module->delete();
    }
}