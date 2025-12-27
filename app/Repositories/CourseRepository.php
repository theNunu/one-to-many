<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{

    public function getAll()
    {
        return Course::with('lessons')->get();
    }
    public function create(array $data)
    {
        // return Course::create($data);
        return Course::create([
            'title'         => $data['title'],
            'description'   => $data['description'],
            'level'         => $data['level'],
            'price'         => $data['price'],
            // 'is_published'  => $data['is_published'],
            'is_active'     => $data['is_active'] ?? true, // 👈 default
            'year_uploaded' => $data['year_uploaded'],
        ]);
    }

    public function findWithLessons(int $id)
    {
        return Course::with('lessons')->findOrFail($id);
    }
}
