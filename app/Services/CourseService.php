<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Models\Mongo\Course as PublicCourse;

class CourseService
{
    private $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAll()
    {
        $courses = $this->courseRepository->getAll();
        $formatted = $courses->map(function ($course) {
            return [
                'id' => $course->course_id,
                'title' => $course->title,
                'description' => $course->description,
                'year_uploaded' => $course->year_uploaded,
                'lessons_count' => $course->lessons->count(), // lo cuenta nmms
                'is_active' => $course->is_active,
                'lessons' => $course->lessons->map(function ($lesson) {
                    return [
                        'id' => $lesson->lesson_id,
                        'title' => $lesson->title,
                        'duration_minutes' => $lesson->duration_minutes,
                        'type' => $lesson->type,
                        // 'content' => $lesson->content,
                    ];
                })
            ];
        });
        return $formatted->groupBy(function ($course) {
            return $course['year_uploaded'] ?? 'sin_año';
        });
    }


    public function createCourse(array $data)
    {
        $course = $this->courseRepository->create($data);

        return $course;
    }

    public function getActiveAndInactives()
    {
        // $courses = Course::select(['course_id','title','year_uploaded','is_active', 'price'])->get();
        $courses = Course::all();

        // return $courses->groupBy(function ($course) {
        //     return $course->is_active ? 'activos' : 'inactivos';
        // });
        return $courses->groupBy(fn ($course)=> 
           $course->is_active ? 'activos' : 'inactivos'
        )->map(function ($group) {
            return $group->map(function ($course) {
                return [
                    'id'    => $course->course_id,
                    'title' => $course->title,
                    'year'  => $course->year_uploaded,
                    'price' => $course->price,
                    'active'=> $course->is_active,
            ];
            });
             });
    }

    public function getCourseWithLessons(int $id)
    {
        return $this->courseRepository->findWithLessons($id);
    }
}
