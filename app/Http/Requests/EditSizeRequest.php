<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditSizeRequest extends FormRequest
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
        $sizeId = $this->route('sizes'); // Lấy ID của bản ghi đang được chỉnh sửa từ URL.
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sizes')->ignore($sizeId), // Thay "categories" bằng tên bảng "categories" của bạn.
            ],
        ];
    }
}
