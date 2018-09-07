<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'ba_lessons';
    protected $primaryKey = 'lesson_id';
    protected $fillable = ['lesson_title', 'lesson_content_version', 'lesson_learning_objectives_tags',
        'lesson_learning_objectives_description', 'lesson_context_id', 'lesson_paradigm_id',
        'lesson_level_of_difficulty_id', 'lesson_learner_ethnicity_LCID_string', 'lesson_LCID_string', 'lesson_first_challenge_id',
        'lesson_passing_percentage', 'lesson_cover_image_url', 'lesson_cover_thumbnail_image_url',
        'lesson_intro_video_url', 'lesson_outro_video_url', 'lesson_completion_badge_url',
        'lesson_passing_badge_url', 'lesson_host_for_url', 'lesson_status_id'];
    protected $appends = ['challenges'];

    private $relatedChallenges = [];

    public function firstChallenge(){
        return $this->hasOne('App\Challenge', 'challenge_id', 'lesson_first_challenge_id');
    }

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

    public function categories(){
        return $this->hasMany('App\LessonCategory', 'lesson_id', 'lesson_id');
    }

    public function courses(){
        return $this->hasManyThrough('App\Course', 'App\CourseLesson', 'lesson_id', 'course_id');
    }

    public function getChallengesAttribute(){
        $firstChallenge = $this->firstChallenge;
        $this->relatedChallenges[] = $firstChallenge;
        return $this->getRelatedChallenges($firstChallenge);
    }

    /**
     * Get all the related challenges based on the responses.
     */
    private function getRelatedChallenges($challenge){
        if($challenge){
            if($challenge->nextChallenges()->count() > 0){
                $challenges = [];
                foreach ($challenge->nextChallenges as $key => $nc){
                    $c = $challenge->nextChallenges[$key]->challenge;
                    $challenges[] = $c;
                    if($c->nextChallenges()->count() > 0){
                        $this->getRelatedChallenges($c);
                    }
                }
                if(count($challenges) > 0){
                    $this->relatedChallenges[] = $challenges;
                }
            }
        }
        return $this->relatedChallenges;
    }
}
