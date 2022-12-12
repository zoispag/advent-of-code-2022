<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DaySeven;

class DaySevenController extends Controller
{
    public function __invoke(DaySeven $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
