<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date', 
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            // "nullable" (opcional)
            'banner' => 'nullable|image|max:2048',
        ];
    }
}
