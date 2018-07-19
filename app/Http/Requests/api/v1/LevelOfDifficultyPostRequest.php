<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LevelOfDifficultyPostRequest extends FormRequest
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
            'difficulty_label' => ['bail', 'required', 'max:15'],
            'difficulty_description' => 'max:100'
        ];
    } //Rule::unique('ba_lkup_levels_of_difficulty')->ignore($this->get('level_of_difficulty_id')),

    public function messages()
    {
        return [
            'difficulty_label.required' => 'Label is required',
            //'difficulty_label.unique' => 'Label already exists',
            'difficulty_label.max' => 'Label too long. Should not exceed 15 characters',
            'difficulty_description.max' => 'Description too long. Should not exceed 100 characters'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return new HttpResponseException(response($validator->errors()->getMessages()));
    }
}
