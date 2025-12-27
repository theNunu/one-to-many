<?php

namespace App\Http\Controllers\Public\Controller;

use App\Http\Controllers\Controller;
use App\Public\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json($courses);
    }
}
