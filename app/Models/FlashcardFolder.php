<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\FlashcardFolderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Flashcard> $flashcards
 * @property-read int|null $flashcards_count
 * @property-read User $owner
 * @method static FlashcardFolderFactory factory($count = null, $state = [])
 * @method static Builder<static>|FlashcardFolder newModelQuery()
 * @method static Builder<static>|FlashcardFolder newQuery()
 * @method static Builder<static>|FlashcardFolder query()
 * @method static Builder<static>|FlashcardFolder whereCreatedAt($value)
 * @method static Builder<static>|FlashcardFolder whereDescription($value)
 * @method static Builder<static>|FlashcardFolder whereId($value)
 * @method static Builder<static>|FlashcardFolder whereName($value)
 * @method static Builder<static>|FlashcardFolder whereOwnerId($value)
 * @method static Builder<static>|FlashcardFolder whereUpdatedAt($value)
 * @mixin Eloquent
 */
class FlashcardFolder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flashcard_folder';

    protected $fillable = [
        'name',
        'description',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class, 'folder_id');
    }
}
