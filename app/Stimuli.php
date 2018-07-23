<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stimuli extends Model
{
    protected $table = 'ba_lkup_stimulii';
    protected $primaryKey = 'stimulus_type_id';
    protected $fillable = ['stimulus_label', 'stimulus_description'];
}
