<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api\v1')->group(function(){
    Route::prefix('v1')->group(function(){
        Route::apiResource('lessons', 'LessonController');
        Route::prefix('settings')->group(function(){
            Route::apiResource('categories', 'CategoryController');
            Route::apiResource('lcids', 'LCIDController');
            Route::apiResource('levels', 'LevelOfDifficultyController');
            Route::apiResource('micro-skills', 'MicroSkillController');
            Route::apiResource('paradigms', 'ParadigmController');
            Route::apiResource('responses', 'ResponseController');
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('skills', 'SkillController');
            Route::apiResource('statuses', 'StatusController');
            Route::apiResource('stimuli', 'StimuliController');
        });
    });
});
