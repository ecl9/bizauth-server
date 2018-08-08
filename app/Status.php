<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'ba_lkup_statuses';
    protected $primaryKey = 'status_id';
    protected $fillable = ['status_label', 'status_description'];
    protected $appends = ['lessonsCount'];

    public function getLessonsCountAttribute(){
        return Lesson::where('lesson_status_id', $this->status_id)->count();
    }
}
