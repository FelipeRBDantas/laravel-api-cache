<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $entity)
    {
        $this->entity = $entity;
    }
    
    public function getAllCourses()
    {
        return $this->entity->get();
    }
    
    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }
}