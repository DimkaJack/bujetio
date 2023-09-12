<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class GetProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => [
                'id' => $this->type->value,
                'label' => $this->type->label(),
            ],
            'typeId' => $this->type->value,
            'startBalanceAmount' => $this->startBalance->formatByDecimal(),
            'startBalanceCurrency' => $this->startBalance->getCurrency(),
            'balanceAmount' => $this->balance->formatByDecimal(),
            'balanceCurrency' => $this->balance->getCurrency(),
            'createdAt' => $this->created_at,
        ];
    }
}