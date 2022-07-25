<?php

namespace App\Services\Cart\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function getListByIds(array $ids): Collection
    {
        return Product::whereIn('id', $ids)->get();
   }
}
