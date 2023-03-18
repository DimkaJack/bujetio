<?php

declare(strict_types=1);

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'color' => [
                'required',
                'string',
                'max:255',
                // validate hex color code
                'regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3})/i',
            ],
        ];
    }
}
