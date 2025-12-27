<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model as MongoModel;
class Lesson extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'lessons';

    protected $primaryKey = '_id';
    public $incrementing = false;

    protected $fillable = [
        '_id',
        'course_id',
        'title',
        'duration_minutes',
        'type',
        'order'
    ];
}
