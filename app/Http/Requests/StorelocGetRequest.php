<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelocGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'n' => __('North'),
            'e' => __('East'),
            's' => __('South'),
            'w' => __('West'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'n' => 'nullable|numeric|max:90|min:-90',
            'e' => 'nullable|numeric|max:180|min:-180',
            's' => 'nullable|numeric|max:90|min:-90',
            'w' => 'nullable|numeric|max:180|min:-180',
            'services' => 'exists:services,id',
            'operator' => 'in:OR,AND',
        ];
    }
}
