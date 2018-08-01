<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LCID extends Model
{
    protected $table = 'ba_lkup_LCIDs';
    protected $primaryKey = 'LCID_string_id';
    protected $keyType = 'string';
    protected $fillable = ['LCID_string_id', 'LCID_description'];
}
