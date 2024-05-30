<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonnelRequest extends FormRequest
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
        $userId = $this->route('user')->id; 

        return [
            'name' => 'sometimes|string|max:255',
            'gender' => 'sometimes|boolean',
            'address' => 'sometimes|string|max:255',
            'citizen_identification_card' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'date_of_birth' => 'sometimes|date',
            'phone_number' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'username' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            // 'password' => 'sometimes|string|min:8|confirmed', // Nếu cho phép cập nhật mật khẩu
            'job_position' => 'sometimes|string|max:255',
            'working_unit' => 'sometimes|string|max:255',
            'salary_level' => 'sometimes|string|max:255',
            'date_start_work' => 'sometimes|date',
            'experience_degree_information' => 'sometimes|string|max:255',
            'note' => 'nullable|string|max:255',
        ];
    }
}
