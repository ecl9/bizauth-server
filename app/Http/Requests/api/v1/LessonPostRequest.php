<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LessonPostRequest extends FormRequest
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
            'lesson_title' => 'bail|required|max:80',
            'lesson_content_version' => 'required',
            'lesson_learning_objectives_tags' => 'bail|required|max:100',
            'lesson_learning_objectives_description' => 'bail|required|max:512',
            'lesson_level_of_difficulty_id' => 'required',
            'lesson_learner_ethnicity_LCID_string' => 'required|max:10',
            'lesson_LCID_string' => 'required|max:10',
            'lesson_passing_percentage' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'lesson_title.required' => 'Title is required',
            'lesson_title.max' => 'Title should not exceed 80 characters',
            'lesson_content_version.required' => 'Content version is required.',
            'lesson_learning_objectives_tags.required' => 'Keywords are required.',
            'lesson_learning_objectives_tags.max' => 'Keywords should not exceed 100 characters.',
            'lesson_learning_objectives_description.required' => 'Text is required.',
            'lesson_learning_objectives_description.max' => 'Text should not exceed 512 characters.',
            'lesson_level_of_difficulty_id.required' => 'Please select a level of difficulty.',
            'lesson_learner_ethnicity_LCID_string.required' => 'Learner ethnicity is required.',
            'lesson_learner_ethnicity_LCID_string.max' => 'Learner ethnicity should not exceed 10 characters.',
            'lesson_LCID_string.required' => 'Lesson ethnicity is required.',
            'lesson_LCID_string.max' => 'Lesson ethnicity should not exceed 10 characters.',
            'lesson_passing_percentage.required' => 'Passing percentage is required.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()->getMessages(), 422));
    }
}
