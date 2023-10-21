<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'name', 'logo', 'fssai_number', 'phone_number', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        if (auth()->check() && auth()->user()->hasRole([
            User::ROLE_RESTAURANT_OWNER,
        ])) {
            static::addGlobalScope('restaurant', function (Builder $query) {
                $query->whereBelongsTo(auth()->user());
            });
        }
    }

    public static function getTenantId(): int
    {
        return User::getTenant()?->id ?? 0;
    }

    /* Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foodCategories(): HasMany
    {
        return $this->hasMany(FoodCategory::class);
    }
}
