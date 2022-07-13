<?php

namespace App\Http\Requests\note;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            //'total' => ['required', 'integer'],
            "items" => ['required', 'array', 'min:1'],
            'items.*.id'  => ['required','integer','min:1'],
            'items.*.quantity'  => ['required','integer','min:1'],
        ];
    }
}
