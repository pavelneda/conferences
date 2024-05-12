<?php

namespace App\Http\Requests\Conference;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'date' => 'required|string',
            'industry_id' => 'required|exists:App\Models\Industry,id',
            'place' => 'required|string',
            'application_deadline' => 'required|string',
            'price' => 'required|integer',
        ];
    }
}
