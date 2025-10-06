<?php

namespace App\Http\Requests\Transaction;

use App\Constants\TransactionTypeEnum;
use App\Http\Requests\BaseFormRequest;
use App\Http\Requests\Transaction\Dto\TransactionStoreDto;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Money\Currency;

class StoreTransactionRequest extends BaseFormRequest
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
            'type' => [
                'required',
                'numeric',
                Rule::in(Arr::pluck(TransactionTypeEnum::cases(), 'value')),
            ],
            'name' => [
                'required',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'amountCurrency' => [
                'required',
                'string',
                'max:4',
            ],
            'productId' => [
                'required',
                Rule::exists(Product::class, 'id'),
            ],
            'categoryId' => [
                'required',
                Rule::exists(Category::class, 'id'),
            ],
            'payDate' => [
                'required',
                'date',
            ],
            'tags' => [
                'array',
            ],
            'tags.*' => [
                'string',
                Rule::exists(Tag::class, 'id'),
            ],
        ];
    }

    public function getDto(): TransactionStoreDto
    {
        return TransactionStoreDto::fromRequest($this);
    }
}
