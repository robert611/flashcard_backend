<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 *
 * @method static Builder|static create(array $attributes = [])
 * @method static Builder|static where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $stripe_id Stripe Customer ID
 * @property string|null $pm_type Payment Method Type
 * @property string|null $pm_last_four Last four digits of the payment method
 * @property Carbon|null $trial_ends_at Trial expiration date
 * @property-read Collection<int, Subscription> $subscriptions User subscriptions
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 *
 * Cashier (Billable) Methods
 * @method void createOrGetStripeCustomer(array $options = []) Create or retrieve a Stripe customer
 * @method string|null stripeId() Get the user's Stripe ID
 * @method bool subscribed(string $name = 'default', string|array $plans = null) Check if user is subscribed
 * @method Subscription|null subscription(string $name = 'default') Get user's subscription
 * @method bool onTrial(string $name = 'default') Check if user is on a trial period
 * @method bool onGracePeriod(string $name = 'default') Check if user is on a grace period after cancellation
 * @method Subscription|null newSubscription(string $name, string $plan) Create a new subscription
 * @method void charge(int $amount, array $options = []) Charge a customer a specific amount
 * @method void invoice() Generate an invoice for the user
 * @method bool hasPaymentMethod() Check if user has a payment method
 *
 *
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'trial_ends_at' => 'datetime',
        ];
    }
}
