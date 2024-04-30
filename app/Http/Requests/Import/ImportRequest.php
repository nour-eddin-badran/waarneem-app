<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'max:2048', 'mimes:json'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.max' => 'The permissible maximum file size is limited to 2 megabytes.',
        ];
    }

    public function jsonContentRules(): array
    {
        return [
            'users.*.id' => 'required|string|max:6',
            'users.*.name' => 'required|string|max:255',
            'users.*.age' => 'required|integer|min:0',
            'users.*.companies' => 'sometimes|array',
            'users.*.companies.*.id' => 'required|string|max:6',
            'users.*.companies.*.name' => 'required|string|max:255',
            'users.*.companies.*.started_at' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
        ];
    }

    public function jsonContentMessages(): array
    {
        return [
            'users.*.id' => __('messages.user_id_required'),
            'users.*.name' => __('messages.user_name_required'),
            'users.*.age' => __('messages.user_age_required'),
            'users.*.companies.*.id' => __('messages.company_id_required'),
            'users.*.companies.*.name' => __('messages.company_name_required'),
            'users.*.companies.*.started_at' => __('messages.company_started_at_required'),
            'users.*.companies.*.started_at.date_format' => __('messages.invalid_started_at_format'),
            'users.*.companies.*.started_at.before_or_equal' => __('messages.started_at_must_be_in_the_past'),
        ];
    }
}
