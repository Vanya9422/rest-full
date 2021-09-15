<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'price', 'published'];

    /**
     * @var string[]
     */
    protected $cascadeDeletes = ['categories'];

    /**
     * @var string[]
     */
    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', '=', 1);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
