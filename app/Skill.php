<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'ba_lkup_skills';
    protected $primaryKey = 'skill_types_id';
    protected $fillable = ['skill_label', 'skill_description'];
}
