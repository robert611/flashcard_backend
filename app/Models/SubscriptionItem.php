<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SubscriptionItemFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $subscription_id
 * @property string $stripe_id
 * @property string $stripe_product
 * @property string $stripe_price
 * @property int|null $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Subscription $subscription
 *
 * @method static SubscriptionItemFactory factory($count = null, $state = [])
 * @method static Builder|SubscriptionItem newModelQuery()
 * @method static Builder|SubscriptionItem newQuery()
 * @method static Builder|SubscriptionItem query()
 * @method static Builder|SubscriptionItem whereId($value)
 * @method static Builder|SubscriptionItem whereSubscriptionId($value)
 * @method static Builder|SubscriptionItem whereStripeId($value)
 * @method static Builder|SubscriptionItem whereStripeProduct($value)
 * @method static Builder|SubscriptionItem whereStripePrice($value)
 * @method static Builder|SubscriptionItem whereQuantity($value)
 * @method static Builder|SubscriptionItem whereCreatedAt($value)
 * @method static Builder|SubscriptionItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class SubscriptionItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscription_items';

    protected $fillable = [
        'subscription_id',
        'stripe_id',
        'stripe_product',
        'stripe_price',
        'quantity',
    ];

    /**
     * Get the subscription that owns the item.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
