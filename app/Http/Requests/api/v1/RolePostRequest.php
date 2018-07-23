<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RolePostRequest extends FormRequest
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
            'role_label' => 'bail|required|max:20',
            'role_description' => 'max:100'
        ];
    }

    public function messages()
    {
        return [
            'role_label.required' => 'Label is required.',
            'role_label.max' => 'Label should not exceed 20 characters',
            'role_description.max' => 'Description should not exceed 100 characters'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()->getMessages()));
    }
}
