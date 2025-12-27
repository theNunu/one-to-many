<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo\Lesson as PublicLesson;

class Lesson extends Model
{
    protected $primaryKey = 'lesson_id';
    protected $table = 'lessons';
    protected $fillable = [
        'course_id',
        'title',
        'duration_minutes',
        'type',
        'is_free',
        'order'
    ];

    protected static function booted()
    {
        static::created(function ($lesson) {
            PublicLesson::create([
                '_id'            => $lesson->lesson_id, // 👈 IMPORTANTE
                'course_id'     => $lesson->course_id,
                'title'          => $lesson->title,
                'duration_minutes' => $lesson->duration_minutes,
                'type'           => $lesson->type,
                'is_free'       => $lesson->is_free,
                'order'          => $lesson->order,
                'description'    => $lesson->description,
            ]);
        });

        static::updated(function ($lesson) {
            PublicLesson::where('_id', $lesson->lesson_id)
                ->update([
                    'title'       => $lesson->title,
                    'course_id'     => $lesson->course_id,
                    'duration_minutes' => $lesson->duration_minutes,
                    'type'           => $lesson->type,
                    'is_free'       => $lesson->is_free,
                    'order'          => $lesson->order,
                    'description'    => $lesson->description,
                ]);
        });

        static::deleted(function ($lesson) {
            PublicLesson::where('_id', $lesson->lesson_id)
                ->delete();
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
