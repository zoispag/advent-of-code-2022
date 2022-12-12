<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayFour;

class DayFourController extends Controller
{
    public function __invoke(DayFour $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
