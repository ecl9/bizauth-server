<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class ChallengePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'challenge_title' => 'bail|required|max:132',
            'challenge_GUI' => 'required',
            'challenge_primary_stimulus_type_id' => 'required',
            'challenge_primary_response_type_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'challenge_title.required' => 'Challenge title is required',
            'challenge_title.max' => 'Challenge title should not be greater than 132 characters.',
            'challenge_GUI.required' => 'Challenge GUI is required',
            'challenge_primary_stimulus_type_id.required' => 'Please select a stimulus type',
            'challenge_primary_response_type_id.required' => 'Please select a response type'
        ];
    }
}
