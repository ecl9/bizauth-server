<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeResponse extends Model
{
    protected $table = 'ba_challenge_responses';
    protected $fillable = ['challenge_id', 'response_max_reward', 'response_GUI', 'response_is_correct',
        'response_retry_challenge'];

    public function nextChallenges(){
        return $this->hasMany('App\ResponseChallenge', 'challenge_response_id');
    }
}
