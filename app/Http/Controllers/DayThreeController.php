<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayThree;

class DayThreeController extends Controller
{
    public function __invoke(DayThree $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
