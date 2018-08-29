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
        info($firstChallenge);
        $this->relatedChallenges[] = $firstChallenge;
        return $this->testRecursion($firstChallenge);
        //return $this->getRelatedChallenges();
    }

    public function testRecursion($challenge){
        if($challenge){
            if($challenge->nextChallenges()->count() > 0){
                $challenges = [];
                foreach ($challenge->nextChallenges as $key => $nc){
                    $c = $challenge->nextChallenges[$key]->challenge;
                    $challenges[] = $c;
                    if($c->nextChallenges()->count() > 0){
                        $this->testRecursion($c);
                    }
                }
                if(count($challenges) > 0){
                    $this->relatedChallenges[] = $challenges;
                }
            }
        }
        return $this->relatedChallenges;
    }

    /**
     * Get all the related challenges based on the responses.
     */
    private function getRelatedChallenges($relatedChallenges = null){
        if(!$relatedChallenges){ $relatedChallenges = []; }
        $len = count($relatedChallenges);
        if(!$len){
            //$c = $this->firstChallenge()->select('challenge_id', 'challenge_title')->get();
            $c = Challenge::find($this->lesson_first_challenge_id); //$this->firstChallenge;
            $relatedChallenges[] = $c;
            $this->getRelatedChallenges($relatedChallenges);
        }else{
            $lastChallenge = $relatedChallenges[$len-1];
            info(is_array($lastChallenge));
            info($lastChallenge);
            if(is_array($lastChallenge)){
                $arr_challenges = [];
                foreach ($lastChallenge as $key => $lc){
                    $arr_challenges[] = $this->getNextChallenges($lc);
                }
                if(count($arr_challenges) > 0){
                    $relatedChallenges[] = $arr_challenges;
                    $this->getRelatedChallenges($relatedChallenges);
                }
            }else{
                $nextChallenges = $this->getNextChallenges($lastChallenge);
                info($nextChallenges);
                if(count($nextChallenges) > 0){
                    $relatedChallenges[] = $nextChallenges;
                    $this->getRelatedChallenges($relatedChallenges);
                }
            }
        }
        return $relatedChallenges;
    }

    private function getNextChallenges($challenge){
        $challenges = [];
        $c = Challenge::with('nextChallenges')->find($challenge['challenge_id']);
        $ncs = $c->nextChallenges;
        if(count($ncs) > 0){
            foreach ($ncs as $key => $nc){
                $challenges[] = $nc->challenge;
            }
        }
        return $challenges;
    }
}
