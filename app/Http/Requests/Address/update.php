<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_jo' => 'required|email',
            'phone_jo' => 'required|numeric',
            'address_jo' => 'required',
            'address_en_jo' => 'required',
            'email_ps' => 'nullable|email',
            'phone_ps' => 'nullable|numeric',
            'address_ps' => 'nullable',
            'address_en_ps' => 'nullable',
        ];
    }
}
