<?php

namespace App\Api\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'long_url' => 'required | url',
        ];
    }

    public function messages()
    {
        return [
            'long_url.required' => 'long_url is required',
            'long_url.url' => 'Invalid Url',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json(
            [
                'errors' => $errors->messages(),
            ],
            409
        );

        throw new HttpResponseException($response);
    }
}
