<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\api\v1\LevelOfDifficultyPostRequest;
use App\LevelOfDifficulty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelOfDifficultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = LevelOfDifficulty::all();
        return response($levels, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelOfDifficultyPostRequest $request)
    {
        $level = LevelOfDifficulty::create($request->all());
        return response($level, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = LevelOfDifficulty::find($id);
        return response($level, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LevelOfDifficultyPostRequest $request, $id)
    {
        $level = LevelOfDifficulty::find($id);
        $level->update($request->all());
        return response($level, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = LevelOfDifficulty::find($id);
        $level->delete();
        return response(null, 204);
    }
}
