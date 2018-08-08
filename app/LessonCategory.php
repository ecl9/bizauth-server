<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonCategory extends Model
{
    protected $table = 'ba_link_lessons_categories';
    protected $fillable = ['lesson_id', 'category_id'];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }
}
