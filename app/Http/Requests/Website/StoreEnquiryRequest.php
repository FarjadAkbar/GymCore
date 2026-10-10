<?php

namespace App\Http\Requests\Website;

use App\Enums\Status;
use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:20'],
            'plan_id' => [
                Rule::requiredIf(fn (): bool => Plan::query()->where('status', Status::Active)->exists()),
                'nullable',
                'integer',
                Rule::exists('plans', 'id'),
            ],
            'return_to' => ['nullable', 'string', Rule::in(['home', 'join'])],
        ];
    }
}
