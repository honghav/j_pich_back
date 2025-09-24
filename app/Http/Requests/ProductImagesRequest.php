<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImagesRequest extends FormRequest
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
            //
            'product_id' => 'required|exists:products,id',
            'image_path' => ['required', 'array', 'min:1'], // at least 1 file
            'image_path.*' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:10240' // 10MB per file
            ],


        ];
    }
}
