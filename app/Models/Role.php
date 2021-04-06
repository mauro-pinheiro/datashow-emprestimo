<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use Filterable;

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope('no-super', function (Builder $builder) {
            $builder->where('name', '!=', config('super.super-admin'));
        });
    }

    public function scopeWhereIsNotSuper($query)
    {
        return $query->where('name', '!=', config('super.super-admin'));
    }
}
