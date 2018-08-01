<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'ba_lessons';
    protected $primaryKey = 'lesson_id';
    protected $fillable = ['lesson_title', 'lesson_content_version', 'lesson_learning_objectives_tags',
        'lesson_learning_objectives_description', 'lesson_context_id', 'lesson_paradigm_id',
        'lesson_level_of_difficulty_id', 'lesson_learner_ethnicity_LCID_string', 'lesson_LCID_string',
        'lesson_passing_percentage', 'lesson_cover_image_url', 'lesson_cover_thumbnail_image_url',
        'lesson_intro_video_url', 'lesson_outro_video_url', 'lesson_completion_badge_url',
        'lesson_passing_badge_url', 'lesson_host_for_url', 'lesson_status_id'];

    public function paradigm(){
        return $this->belongsTo('App\Paradigm', 'lesson_paradigm_id', 'paradigm_id');
    }

    public function difficulty(){
        return $this->belongsTo('App\LevelOfDifficulty', 'lesson_level_of_difficulty_id', 'level_of_difficulty_id');
    }

    public function role(){
        return $this->belongsTo('App\Role', 'lesson_context_id', 'role_id');
    }

    public function status(){
        return $this->belongsTo('App\Status', 'lesson_status_id', 'status_id');
    }

    public function courses(){
        return $this->hasManyThrough('App\Course', 'App\CourseLesson', 'lesson_id', 'course_id');
    }
}
