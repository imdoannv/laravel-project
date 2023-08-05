<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Kiểm tra xem category_id có tồn tại trong bảng 'categories' không.
            'descrip' => 'nullable|string', // Cho phép descrip có thể là null hoặc là một chuỗi.
            'quantity' => 'required|integer|min:1', // Số lượng phải là một số nguyên không âm.
            'size_id' => 'required|exists:sizes,id', // Kích thước phải là một chuỗi có độ dài tối đa 50 ký tự.
        ];
    }
}
