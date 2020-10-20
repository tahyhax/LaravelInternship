<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class MainController extends Controller
{
    protected $perPage = 12;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        //TODO  сделать repository для  работы с базой. не писать сами запросы  в  контроллере
        $products = Product::query()->orderByDesc('id')->paginate($this->perPage);

        return view('front.main.index')->with(compact(['products']));
    }
}
