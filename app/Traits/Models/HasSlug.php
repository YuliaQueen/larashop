<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $model->makeSlug();
        });
    }

    protected function makeSLug(): void
    {
        if (!$this->{$this->slugColumn()}) {
            $slug = $this->slugUnique(
                str($this->{$this->slugFrom()})
                    ->slug()
                    ->value()
            );

            $this->{$this->slugColumn()} = $slug;
        }
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected function slugFrom(): string
    {
        return 'title';
    }

    private function slugUnique(string $slug): string
    {
        $originSlug = $slug;
        $i = 0;

        while ($this->isSlugExist($slug)) {
            $i++;

            $slug = $originSlug . '-' . $i;
        }

        return $slug;
    }

    private function isSlugExist(string $slug): bool
    {
        $query = $this->newQuery()
            ->where(self::slugColumn(), $slug)
            ->withoutGlobalScopes();

        return $query->exists();
    }
}
