<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $entity)
    {
        $this->entity = $entity;
    }
    
    public function getAllCourses()
    {
        return Cache::rememberForever('courses', function () {
            return $this->entity
                ->with('modules.lessons')
                ->get();
        });
        // return Cache::remember('courses', 60, function () {
        //     return $this->entity
        //         ->with('modules.lessons')
        //         ->get();
        // });
    }
    
    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }
    
    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        return $this->entity
            ->where('uuid', $identify)
            ->with([$loadRelationships ? 'modules.lessons' : ''])
            ->firstOrFail();
    }
    
    public function deleteCourseByUuid($identify)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->delete();
    }
    
    public function updateCourseByUuid($identify, $data)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->update($data);
    }
}