<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use App\Models\Image;
use App\Models\Product;
use App\Traits\Filterable;

class MainController extends Controller
{
    use Filterable;
    /**
     * @var int $perPage
     */
    protected $perPage = 12;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProductFilters $filtes)
    {
        //TODO  сделать repository для  работы с базой. не писать сами запросы  в  контроллере
        $products = Product::query()->filter($filtes)->orderByDesc('id')->paginate($this->perPage);

        //TODO   как правильно сделать !!
        $slideImages = Image::query()->with('product')->latest('id')->limit(5)->get();
        return view('front.main.index')->with(compact(['products', 'slideImages']));
    }
}
