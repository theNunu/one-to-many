<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(){
        return $this->courseService->getAll();
    }

    public function store(StoreCourseRequest $request)
    {
        return response()->json(
            $this->courseService->createCourse($request->validated()),
            201
        );
    }

    public function show($id)
    {
        return $this->courseService->getCourseWithLessons($id);
    }


    public function getActiveAndInactives(){
        return $this->courseService->getActiveAndInactives();
    }
}
