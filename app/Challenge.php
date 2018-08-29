<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'ba_challenges';
    protected $primaryKey = 'challenge_id';
    protected $fillable = ['challenge_title', 'challenge_GUI', 'challenge_hint_GUI', 'challenge_hint_max_penalty', 'challenge_primary_stimulus_type_id',
        'challenge_primary_response_type_id', 'challenge_retry_point_penalty', 'challenge_response_timelimit',
        'challenge_assessing'];

    public function challengeMicroSkills(){
        return $this->hasMany('App\ChallengeSkill', 'challenge_id', 'challenge_id');
    }

    public function challengeResponses(){
        return $this->hasMany('App\ChallengeResponse', 'challenge_id', 'challenge_id');
    }

    public function nextChallenges(){
        return $this->hasManyThrough('App\ResponseChallenge', 'App\ChallengeResponse',
            'challenge_id', 'challenge_response_id', 'challenge_id', 'id');
    }
}
