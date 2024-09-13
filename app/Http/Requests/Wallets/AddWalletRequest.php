<?php

namespace App\Http\Requests\Wallets;

use Illuminate\Foundation\Http\FormRequest;

class AddWalletRequest extends FormRequest
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
            'name'      => 'required|string|min:5|max:255',
            'balance'   => 'sometimes|numeric',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
