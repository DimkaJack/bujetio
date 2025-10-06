<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
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
            //@todo add Bank name
            'type' => [
                'id' => $this->type->value,
                'label' => $this->type->label(),
            ],
            'typeId' => $this->type->value,
            'startBalanceAmount' => $this->startBalance->formatByDecimal(),
            'startBalanceCurrency' => $this->startBalance->getCurrency(),
            'balanceAmount' => $this->balance->formatByDecimal(),
            'balanceCurrency' => $this->balance->getCurrency(),
            'bankLoanAmount' => $this->bankLoan->formatByDecimal(),
            'createdAt' => $this->created_at,
        ];
    }
}
