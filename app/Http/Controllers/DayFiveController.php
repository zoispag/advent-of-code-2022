<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayFive;

class DayFiveController extends Controller
{
    public function __invoke(DayFive $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
