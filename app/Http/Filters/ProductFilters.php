<?php

namespace App\Http\Filters;

use Illuminate\Database\Query\Builder;

/**
 * @method Builder apply(Builder $builder)
 */
class ProductFilters extends QueryFilters
{

    /**
     * @param string $categories
     * @return Builder
     */
    public function categories(string $categories): Builder
    {
        return $this->builder->whereHas('categories', function ($query) use ($categories) {

            /* @var Builder $query */
            $query->whereIn('slug', $this->paramToArray($categories));
        });

    }

    /**
     * @param string $brands
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function brands(string $brands): \Illuminate\Database\Eloquent\Builder
    {
        return $this->builder->whereHas('brand', function ($query) use ($brands) {

            /* @var Builder $query */
            $query->whereIn('slug', $this->paramToArray($brands));
        });
    }

    /**
     * @param string $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(string $sort): \Illuminate\Database\Eloquent\Builder
    {
        return $this->builder->orderBy($sort, 'ASC');
    }

    /**
     * @param string $price
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function price(string $price): \Illuminate\Database\Eloquent\Builder
    {
        return $this->builder->whereBetween('price', $this->paramBetweenToArray($price));
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($keyword): \Illuminate\Database\Eloquent\Builder
    {
        return $this->builder->where('name', 'like', '%' . $keyword . '%');
    }

}
