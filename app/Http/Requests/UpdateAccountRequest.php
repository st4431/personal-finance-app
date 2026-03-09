<?php

namespace App\Http\Requests;

use App\Enums\AccountCategory;
use App\Enums\AccountType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name' => 'required|max:255',
            'type' => ['required', Rule::in(AccountType::cases())],
            'category' => ['required', Rule::in(AccountCategory::cases())],
        ];
    }
}
