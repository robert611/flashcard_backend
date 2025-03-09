<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Eloquent;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $key
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $owner
 * @mixin Eloquent
 */
class Classroom extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classroom';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'key',
        'owner_id',
    ];

    /**
     * Automatically generate a unique key when creating a new classroom.
     */
    protected static function booted(): void
    {
        static::creating(function (Classroom $classroom) {
            do {
                $key = Str::random(12);
            } while (self::where('key', $key)->exists());

            $classroom->key = $key;
        });
    }

    /**
     * Get the owner of the classroom.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the flashcards associated with the classroom.
     */
    public function flashcardFolders(): HasMany
    {
        return $this->hasMany(FlashcardFolder::class);
    }
}
