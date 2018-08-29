<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeSkill extends Model
{
    protected $table = 'ba_link_challenge_micro_skills';
    protected $fillable = ['challenge_id', 'skill_evaluated_id', 'micro_skill_id', 'level_of_difficulty_id'];

    public function skill(){
        return $this->belongsTo('App\Skill', 'skill_evaluated_id', 'skill_types_id');
    }

    public function microSkill(){
        return $this->belongsTo('App\MicroSkill', 'micro_skill_id', 'micro_skill_types_id');
    }

    public function difficulty(){
        return $this->belongsTo('App\LevelOfDifficulty', 'level_of_difficulty_id', 'level_of_difficulty_id');
    }
}
