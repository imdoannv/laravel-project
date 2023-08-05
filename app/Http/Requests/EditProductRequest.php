<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('images');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('images')->ignore($id),
            ],
            'category_id' => 'required|exists:categories,id',
            'descrip' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string|max:5|exists:sizes,id',
        ];
    }
}
