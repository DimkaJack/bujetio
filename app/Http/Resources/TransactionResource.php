<?php

declare(strict_types=1);

namespace App\Http\Resources;

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
            'type' => [
                'id' => $this->type->value,
                'label' => $this->type->label(),
            ],
            'amount' => (int) $this->amount->getAmount(),
            'amountCurrency' => $this->amount->getCurrency()->getCode(),
            'product' => new ProductResource($this->product),
            'category' => new CategoryResource($this->category),
            'createdAt' => $this->created_at,
        ];
    }
}
