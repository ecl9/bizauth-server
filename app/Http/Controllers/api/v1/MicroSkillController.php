<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\api\v1\MicroSkillPostRequest;
use App\MicroSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MicroSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = MicroSkill::orderBy('micro_skill_label', 'asc')->get();
        return response($skills, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MicroSkillPostRequest $request)
    {
        $skill = MicroSkill::create($request->all());
        return response($skill, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill = MicroSkill::find($id);
        return response($skill, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MicroSkillPostRequest $request, $id)
    {
        $skill = MicroSkill::find($id);
        $skill->update($request->all());
        return response($skill, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = MicroSkill::find($id);
        $skill->delete();
        return response(null, 200);
    }
}
