<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo\Course as coursePublic;

class Course extends Model
{
    protected $primaryKey = 'course_id';
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'description',
        'level',
        'price',
        'is_published',
        'is_active',
        'year_uploaded',
    ];

    protected static function booted()
    {
        static::created(function ($course) {
            coursePublic::create([
                '_id'            => $course->course_id, // 👈 IMPORTANTE
                'title'          => $course->title,
                'description'    => $course->description,
                'level'          => $course->level,
                'price'          => $course->price,
                'is_published'   => $course->is_published,
                'year_uploaded'  => $course->year_uploaded,

            ]);
        });

        static::updated(function ($course) {
            coursePublic::where('_id', $course->course_id)
                ->update([
                    '_id'            => $course->course_id, // 👈 IMPORTANTE
                    'title'          => $course->title,
                    'description'    => $course->description,
                    'level'          => $course->level,
                    'price'          => $course->price,
                    'is_published'   => $course->is_published,
                    'year_uploaded'  => $course->year_uploaded,
                ]);
        });

        static::deleted(function ($course) {
            coursePublic::where('_id', $course->course_id)
                ->delete();
        });
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
