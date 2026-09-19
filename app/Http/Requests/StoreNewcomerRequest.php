<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewcomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // form public, ai cũng gửi được
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'hometown' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ.',
            'email.email' => 'Email không hợp lệ.',
        ];
    }
}
