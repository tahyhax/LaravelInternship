<?php

namespace App\Http\Filters;

use Illuminate\Database\Query\Builder;

class ProductFilters extends QueryFilters
{

    /**
     * @param string $categories
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function categories(string $categories)
    {
        return $this->builder->whereHas('categories', function ($query) use ($categories) {

            /* @var Builder $query*/
            $query->whereIn('slug', $this->paramToArray($categories));
        });

    }

    /**
     * @param string $brands
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function brands(string $brands)
    {
        return $this->builder->whereHas('brand', function($query) use ($brands) {

            /* @var Builder $query*/
            $query->whereIn('slug', $this->paramToArray($brands));
        });
    }

    /**
     * @param string $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(string $sort)
    {
        return $this->builder->orderBy($sort, 'ASC');
    }

    /**
     * @param string $price
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function price(string $price)
    {
        return $this->builder->whereBetween('price', $this->paramBetweenToArray($price));
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($keyword)
    {
        return $this->builder->where('name', 'like', '%'.$keyword.'%');
    }

}