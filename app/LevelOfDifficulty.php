<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelOfDifficulty extends Model
{
    protected $table = 'ba_lkup_levels_of_difficulty';
    protected $primaryKey = 'level_of_difficulty_id';
    protected $fillable = ['level_of_difficulty_id', 'difficulty_label', 'difficulty_description'];
}
