<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MicroSkill extends Model
{
    protected $table = 'ba_lkup_micro_skills';
    protected $primaryKey = 'micro_skill_types_id';
    protected $fillable = ['micro_skill_label', 'micro_skill_description'];
}
