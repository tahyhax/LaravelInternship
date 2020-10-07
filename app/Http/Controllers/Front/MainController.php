<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

use App\Models\Product;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const MAIN_PRODUCTS_COUNT = 12;

    public function __invoke()
    {
        //TODO  сделать repository для  работы с базой. не писать сами запросы  в  контроллере
        $products = Product::query()->orderByDesc('id')->paginate(self::MAIN_PRODUCTS_COUNT);

        return view('front.main.index')->with(compact('products'));
    }
}
