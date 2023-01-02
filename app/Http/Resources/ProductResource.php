<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'type' => $this->type->label(),
            'startBalanceAmount' => $this->start_balance_amount,
            'startBalanceCurrency' => $this->start_balance_currency,
            'balanceAmount' => $this->balance_amount,
            'balanceCurrency' => $this->balance_currency,
            'createdAt' => $this->created_at,
        ];
    }
}
