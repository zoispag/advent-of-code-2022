<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayEleven;

class DayElevenController extends Controller
{
    public function __invoke(DayEleven $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
