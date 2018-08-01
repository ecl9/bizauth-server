<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\api\v1\LessonPostRequest;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('lesson_title', 'asc')
            ->with('paradigm:paradigm_id,paradigm_label')
            ->with('difficulty:level_of_difficulty_id,difficulty_label')
            ->with('status:status_id,status_label')
            ->with('courses')
            ->select('lesson_title', 'lesson_content_version', 'lesson_paradigm_id', 'lesson_level_of_difficulty_id', 'lesson_status_id')
            ->get();
        return response($lessons, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonPostRequest $request)
    {
        $lesson = Lesson::create($request->all());
        return response($lesson, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        return response($lesson, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonPostRequest $request, $id)
    {
        $lesson = Lesson::find($id);
        $lesson->update($request->all());
        return response($lesson, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return response(null, 204);
    }
}
