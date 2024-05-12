<?php

namespace App\Http\Requests\Material;

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
            'file' => 'nullable|file|mimes:doc,pdf,docx,zip,odt|max:10240',
            'author' => 'required|string',
            'path' => 'required|string',
            'topic' => 'required|string',
            'industry_id' => 'required|exists:App\Models\Industry,id',
            'university' => 'required|string',
        ];
    }
}
