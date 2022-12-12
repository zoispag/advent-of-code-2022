<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayTwo;

class DayTwoController extends Controller
{
    public function __invoke(DayTwo $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
