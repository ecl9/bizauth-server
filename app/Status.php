<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'ba_lkup_statuses';
    protected $primaryKey = 'status_id';
    protected $fillable = ['status_label', 'status_description'];
}
