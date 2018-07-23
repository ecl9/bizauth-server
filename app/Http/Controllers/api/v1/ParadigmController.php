<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\api\v1\ParadigmPostRequest;
use App\Paradigm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParadigmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paradigms = Paradigm::orderBy('paradigm_label')->get();
        return response($paradigms, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParadigmPostRequest $request)
    {
        $paradigm = Paradigm::create($request->all());
        return response($paradigm, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paradigm = Paradigm::find($id);
        return response($paradigm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParadigmPostRequest $request, $id)
    {
        $paradigm = Paradigm::find($id);
        $paradigm->update($request->all());
        return response($paradigm, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paradigm = Paradigm::find($id);
        $paradigm->delete();
        return response(null, 204);
    }
}
