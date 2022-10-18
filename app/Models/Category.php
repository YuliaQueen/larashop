<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            $category->slug = $category->slug ?? str($category->title)->slug();
        });
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
