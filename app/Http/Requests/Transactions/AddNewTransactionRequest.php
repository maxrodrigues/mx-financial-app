<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class AddNewTransactionRequest extends FormRequest
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
            'type'           => 'required|in:debit,credit',
            'amount'         => 'required|numeric',
            'transaction_at' => 'required|date',
            'description'    => 'required|string',
            'observations'   => 'sometimes|string',
        ];
    }
}
