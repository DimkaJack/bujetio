<?php

namespace App\Models;

use App\Constants\ProductTypeEnum;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property string $id
 * @property string $name
 * @property ProductTypeEnum $type
 * @property Money $startBalance
 * @property int $start_balance_amount
 * @property string $start_balance_currency
 * @property Money $balance
 * @property int $balance_amount
 * @property string $balance_currency
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBalanceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStartBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStartBalanceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => ProductTypeEnum::class,
    ];

    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => money(
                $attributes['balance_amount'],
                currency($attributes['balance_currency']),
            ),
            set: fn (Money $value) => [
                'balance_amount' => (int) $value->getAmount(),
                'balance_currency' => $value->getCurrency()->getCode(),
            ],
        );
    }

    //@todo create start balance automatically
    protected function startBalance(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => money(
                $attributes['start_balance_amount'],
                currency($attributes['start_balance_currency']),
            ),
            set: fn (Money $value) => [
                'start_balance_amount' => (int) $value->getAmount(),
                'start_balance_currency' => $value->getCurrency()->getCode(),
            ],
        );
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
