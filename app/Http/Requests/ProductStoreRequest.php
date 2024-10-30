<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title.ar'       => 'required|max:191',
            'title.en'       => 'required|max:191',
            'description.ar' => 'required',
            'description.en' => 'required',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:categories,id',
            'images'         => 'required|array',
            'images.*'       => 'required|image|mimes:jpg,jpeg,png',
            'image'          => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        ];
    }
}
