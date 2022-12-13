<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayEight;

class DayEightController extends Controller
{
    public function __invoke(DayEight $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
