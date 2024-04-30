<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'file' => 'required|file|mimes:doc,pdf,docx,zip,odt|max:10240',
            'author' => 'required|string',
            'topic' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'industry_id' => 'required|exists:App\Models\Industry,id',
            'conference_id' => 'required|exists:App\Models\Conference,id',
            'university' => 'required|string',
        ];
    }
}
