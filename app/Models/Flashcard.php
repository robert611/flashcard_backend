<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $owner
 * @method static Builder<static>|Flashcard newModelQuery()
 * @method static Builder<static>|Flashcard newQuery()
 * @method static Builder<static>|Flashcard query()
 * @method static Builder<static>|Flashcard whereCreatedAt($value)
 * @method static Builder<static>|Flashcard whereId($value)
 * @method static Builder<static>|Flashcard whereName($value)
 * @method static Builder<static>|Flashcard whereOwnerId($value)
 * @method static Builder<static>|Flashcard whereUpdatedAt($value)
 * @method static Builder<static>|Flashcard whereValue($value)
 * @mixin Eloquent
 */
class Flashcard extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flashcard';

    protected $fillable = [
        'name',
        'value',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
