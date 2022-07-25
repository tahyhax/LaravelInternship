<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * @return Factory|View
     */
    public function __invoke(): Factory|View
    {
        return view('dashboard.main.index');
    }
}
