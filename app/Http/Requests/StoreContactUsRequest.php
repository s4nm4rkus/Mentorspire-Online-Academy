<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Email Address is required.',
            'email.email' => 'The email must be a valid email address.',
            'message.required' => 'Message is required.'
        ];
    }
}
