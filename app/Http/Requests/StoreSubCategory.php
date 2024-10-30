<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategory extends FormRequest
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
            'name.en'    => 'required|string|max:255',
            'name.ar'    => 'required|string|max:255',
            'parent_id'  => 'required|nullable|exists:categories,id',
            'image'      => 'required|image|mimes:jpg,jpeg,png,gif|max:20000',
        ];
    }
}
