<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Lesson;

class LessonRepository
{
    // public function createForCourse(Course $course, array $data)
    // {
    //     return $course->lessons()->create($data);
    // }
    public function createForCourse(array $data)
    {
        return Lesson::create($data);
    }
}
