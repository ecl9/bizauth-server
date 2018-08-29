<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseChallenge extends Model
{
    protected $table = 'ba_link_response_challenges';
    protected $fillable = ['challenge_response_id', 'next_challenge_id'];

    public function challenge(){
        return $this->belongsTo('App\Challenge','next_challenge_id', 'challenge_id');
    }
}
