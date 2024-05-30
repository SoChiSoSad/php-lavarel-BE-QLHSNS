<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'address' => 'required|string|max:255',
            'citizen_identification_card' => 'required|string|max:255|unique:users',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'job_position' => 'required|string|max:255',
            'working_unit' => 'required|string|max:255',
            'salary_level' => 'required|string|max:255',
            'date_start_work' => 'required|date',
            'experience_degree_information' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
        ];
    }
}
