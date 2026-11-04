<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'author' => ['nullable', 'string', 'max:60'],
            'body' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'stars.required' => __('testimoni.form.stars_required'),
            'stars.min' => __('testimoni.form.stars_required'),
            'body.required' => __('testimoni.form.body_required'),
            'body.min' => __('testimoni.form.body_min'),
            'body.max' => __('testimoni.form.body_max'),
        ];
    }
}
