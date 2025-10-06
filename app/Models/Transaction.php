<?php

namespace App\Models;

use App\Constants\TransactionTypeEnum;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Cknow\Money\Money;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @property-read Category $category
 * @property-read Product $product
 * @property-read User $user
 * @property-read Collection<int, Tag> $tags
 * @method static TransactionFactory factory(...$parameters)
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereAmountAmount($value)
 * @method static Builder|Transaction whereAmountCurrency($value)
 * @method static Builder|Transaction whereCategoryId($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereProductId($value)
 * @method static Builder|Transaction whereType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereUserId($value)
 * @method static Builder|Transaction whereName($value)
 * @method static Builder|Transaction wherePayDate($value)
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
