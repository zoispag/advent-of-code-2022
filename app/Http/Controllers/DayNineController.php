<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayNine;

class DayNineController extends Controller
{
    public function __invoke(DayNine $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
