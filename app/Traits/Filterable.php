<?php

namespace App\Traits;

use App\Http\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilters $filter
     */
    public function scopeFilter(Builder $builder, QueryFilters $filter): void
    {
        $filter->apply($builder);
    }
}

?>
