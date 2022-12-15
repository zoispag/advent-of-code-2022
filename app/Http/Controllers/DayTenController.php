<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DayTen;

class DayTenController extends Controller
{
    public function __invoke(DayTen $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
