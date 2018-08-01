<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $table = 'ba_link_courses_lessons';
    protected $fillable = ['lesson_id', 'course_id'];
}
