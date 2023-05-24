<?php

namespace App\Http\Requests\APIs;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    // protected $stopOnFirstFailure = true;
    protected $redirect = $this->validator;

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            return $validator->errors();
        });
    }
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
            'name'=>"required|max:255",
            'berth_day'=>"required|max:255",
            'gender'=>"required|in:male,female",
            'phone'=>"required|unique:users,phone",
            'password'=>"required|min:8|max:255",
            'fcm_token'=>"nullable",
        ];
    }
}
