<?php

namespace App\Http\Controllers\api\v1;

use App\Challenge;
use App\Http\Requests\api\v1\ChallengePostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Challenge::orderBy('challenge_title', 'asc')->get();
        return response($challenges, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChallengePostRequest $request)
    {
        $challenge = Challenge::create($request->except(['challenge_responses', 'response_challenges', 'challenge_micro_skills']));
        if($request->get('challenge_micro_skills')){
            $challenge->challengeMicroSkills()->createMany($request->get('challenge_micro_skills'));
        }
        if($request->get('challenge_responses')){
            $challengeResponses = $request->get('challenge_responses');
            foreach ($challengeResponses as $key => $value) {
                $challengeResponse = $challenge->challengeResponses()->create($value);
                if(array_key_exists('next_challenges', $value)){
                    $challengeResponse->nextChallenges()->createMany($value['next_challenges']);
                }
            }
        }
        return response($challenge, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::find($id);
        $challenge->load('challengeMicroSkills');
        $challenge->load(['challengeResponses' => function($q){
            $q->with(['nextChallenges' => function($q){
                $q->with(['challenge' => function($q){
                    $q->select('challenge_id', 'challenge_title');
                }]);
            }]);
        }]);
        return response($challenge, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChallengePostRequest $request, $id)
    {
        $challenge = Challenge::find($id);
        $challenge->update($request->except(['challengeResponses', 'responseChallenges', 'challengeMicroSkills']));
        return response($challenge, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
