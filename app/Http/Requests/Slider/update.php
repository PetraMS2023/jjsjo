<?php

namespace App\Http\Requests\Slider;

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
            'title'    => 'nullable|string|max:255',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'     => 'nullable|string|max:255',
            'video'    => 'nullable|file|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000',
            'images'   => 'sometimes|array',
            'images.*' => 'sometimes|image|mimes:jpg,jpeg,png',
        ];
    }
}
