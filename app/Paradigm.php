<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paradigm extends Model
{
    protected $table = 'ba_lkup_paradigms';
    protected $primaryKey = 'paradigm_id';
    protected $fillable = ['paradigm_label', 'paradigm_description'];
}
