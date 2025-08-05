<?php

namespace App\Http\Requests\Product;

use App\Constants\ProductTypeEnum;
use App\Contracts\DtoContract;
use App\Http\Requests\BaseFormRequest;
use App\Http\Requests\Product\Dto\ProductUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest
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
            'type' => [
                'required',
                'numeric',
                Rule::in(Arr::pluck(ProductTypeEnum::cases(), 'value')),
            ],
            'startBalanceAmount' => [
                'required',
                'numeric',
            ],
            'startBalanceCurrency' => [
                'required',
                'string',
                'max:4',
            ],
            'balanceAmount' => [
                'required',
                'numeric',
            ],
            'balanceCurrency' => [
                'required',
                'string',
                'max:4',
            ],
            'bankLoanAmount' => [
                'requiredIf:type,' . ProductTypeEnum::CREDIT_LOAN->value,
                'requiredIf:type,' . ProductTypeEnum::CREDIT_LOAN->value,
                'numeric',
            ],
        ];
    }

    public function getDto(): ProductUpdateDto
    {
        return ProductUpdateDto::fromRequest($this);
    }
}
