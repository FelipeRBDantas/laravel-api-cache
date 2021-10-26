<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->courseRepository->getAllCourses();
    }

    public function createNewCourse(array $data)
    {
        return $this->courseRepository->createNewCourse($data);
    }

    public function getCourse($identify)
    {
        return $this->courseRepository->getCourseByUuid($identify);
    }

    public function deleteCourse($identify)
    {
        return $this->courseRepository->deleteCourseByUuid($identify);
    }

    public function updateCourse($identify, array $data)
    {
        return $this->courseRepository->updateCourseByUuid($identify, $data);
    }
}