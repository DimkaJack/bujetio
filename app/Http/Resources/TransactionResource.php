<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Constants\TransactionTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => TransactionTypeEnum::from($this->type)->label(),
            'amount' => $this->amount_amount,
            'amountCurrency' => $this->amount_currency,
            'product' => new ProductResource($this->product),
            'category' => new CategoryResource($this->category),
            'createdAt' => $this->created_at,
        ];
    }
}
