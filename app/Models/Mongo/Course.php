<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model as MongoModel;

class Course extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'courses';
    protected $primaryKey = '_id';
    public $incrementing = false;

    protected $fillable = [
        '_id',
        'title',
        'description',
        'year_uploaded',
        'level',
        'price',
        // 'lessons_count',
        'is_published'
        // '_id',
        // 'title',
        // 'description',
        // 'year_uploaded',
        // 'lessons_count',
        // 'lessons'
    ];
}
