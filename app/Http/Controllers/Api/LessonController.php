<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Models\Course;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lessonService;
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function store(StoreLessonRequest $request)
    {
        return response()->json(
            $this->lessonService->addLessonToCourse($request->validated()),
            201
        );
    }
}
