<?php

namespace App\Public\Services;

use App\Models\Mongo\Lesson;
use App\Public\Repositories\CourseRepository;

// use \Public\Repositories\CourseRepository;
class CourseService
{

    protected $courseRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses()
    {
        $courses = $this->courseRepository->allCourses(); //https://chatgpt.com/c/694c066a-a0b0-832d-9975-e93f6e60c2af

        $courseIds = $courses->pluck('_id')->toArray();
        $lessons = Lesson::whereIn('course_id', $courseIds)->get();
        // dd($lessons);
        return $courses->map(function ($course) use ($lessons) {
            $courseLessons = $lessons->where('course_id', $course->_id)->values();
            $course->lessons = $courseLessons;
            return $course;
        });

    }
}
