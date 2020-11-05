<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('dashboard.main.index');
    }
}
