<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseFormRequest;
use App\Http\Requests\Tag\Dto\TagUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends BaseFormRequest
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

    public function getDto(): TagUpdateDto
    {
        return TagUpdateDto::fromRequest($this);
    }
}
