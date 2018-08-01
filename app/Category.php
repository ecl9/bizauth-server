<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ba_categories';
    protected $primaryKey = 'category_id';
    protected $fillable = ['category_label'];
}
