<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\api\v1\StimuliPostRequest;
use App\Stimuli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StimuliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stimulus = Stimuli::orderBy('stimulus_label')->get();
        return response($stimulus, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StimuliPostRequest $request)
    {
        $stimuli = Stimuli::create($request->all());
        return response($stimuli, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stimuli = Stimuli::find($id);
        return response($stimuli, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StimuliPostRequest $request, $id)
    {
        $stimuli = Stimuli::find($id);
        $stimuli->update($request->all());
        return response($stimuli, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stimuli = Stimuli::find($id);
        $stimuli->delete();
        return response(null, 204);
    }
}
