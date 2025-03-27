<?php

declare(strict_types=1);

namespace App\Http\Resources\Transaction;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\Product\GetProductResource;
use App\Http\Resources\TagResource;
use App\Models\Transaction;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Transaction
 */
class GetTransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => [
                'id' => $this->type->value,
                'label' => $this->type->label(),
            ],
            'name' => $this->name,
            'amount' => $this->amount->formatByDecimal(),
            'amountCurrency' => $this->amount->getCurrency(),
            'product' => new GetProductResource($this->product),
            'category' => new CategoryResource($this->category),
            'payDate' => $this->pay_date,
            'tags' => TagResource::collection($this->tags),
            'createdAt' => $this->created_at,
        ];
    }
}
