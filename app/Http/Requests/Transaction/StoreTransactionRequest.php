<?php

namespace App\Http\Requests\Transaction;

use App\Constants\TransactionTypeEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Money\Currency;

class StoreTransactionRequest extends FormRequest
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
        ];
    }
}
