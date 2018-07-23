<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ba_lkup_roles';
    protected $primaryKey = 'role_id';
    protected $fillable = ['role_label', 'role_description'];
}
