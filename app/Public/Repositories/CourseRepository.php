<?php

namespace App\Public\Repositories;

use App\Models\Mongo\Course;

class CourseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function allCourses()
    {
        return Course::all();
        // Lógica para obtener todos los cursos
    }
}
