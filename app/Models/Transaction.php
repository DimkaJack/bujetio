<?php

namespace App\Models;

use App\Constants\ProductTypeEnum;
use App\Constants\TransactionTypeEnum;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property string $id
 * @property TransactionTypeEnum $type
 * @property string $product_id
 * @property string $category_id
 * @property string $user_id
 * @property int $amount_amount
 * @property string $amount_currency
 * @property Money $amount
 * @todo add old balance and new balance
 * @property string $name
 * @property string $pay_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmountCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayDate($value)
 * @mixin Eloquent
 */
class Transaction extends Model
{
    use HasFactory;
    use HasUuids;

    protected $casts = [
        'type' => TransactionTypeEnum::class,
    ];
    //@todo add product balance to each transaction

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => money(
                $attributes['amount_amount'],
                currency($attributes['amount_currency']),
            ),
            set: fn (Money $value) => [
                'amount_amount' => (int) $value->getAmount(),
                'amount_currency' => $value->getCurrency()->getCode(),
            ],
        );
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
