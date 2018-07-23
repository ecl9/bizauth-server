<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'ba_lkup_responses';
    protected $primaryKey = 'response_type_id';
    protected $fillable = ['response_label', 'response_description'];
}
