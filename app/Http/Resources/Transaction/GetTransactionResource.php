<?php

declare(strict_types=1);

namespace App\Http\Resources\Transaction;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\Product\GetProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTransactionResource extends JsonResource
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
            'amount' => $this->amount->formatByDecimal(),
            'amountCurrency' => $this->amount->getCurrency(),
            'product' => new GetProductResource($this->product),
            'category' => new CategoryResource($this->category),
            'createdAt' => $this->created_at,
        ];
    }
}
