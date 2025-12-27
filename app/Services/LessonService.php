<?php
namespace App\Services;

use App\Models\Course;
use App\Repositories\LessonRepository;

class LessonService
{
    protected $lessonRepository;
    public function __construct(LessonRepository $lessonRepository) {
        $this->lessonRepository = $lessonRepository;
    }

    public function addLessonToCourse($data)
    {
        return $this->lessonRepository->createForCourse($data);
    }
}
