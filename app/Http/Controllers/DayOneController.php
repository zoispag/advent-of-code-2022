<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayOne;

class DayOneController extends Controller
{
    public function __invoke(DayOne $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
