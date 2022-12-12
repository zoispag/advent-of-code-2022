<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function __invoke()
    {
        $routes = collect(Route::getRoutes())
            ->map(fn (\Illuminate\Routing\Route $route) => $route->getName())
            ->filter(fn ($route) => str($route)->startsWith('day-'))
            ->all();

        return view('home')->with('routes', $routes);
    }
}
