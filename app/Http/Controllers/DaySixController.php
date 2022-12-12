<?php

namespace App\Http\Controllers;

use App\Actions\Challenges\DaySix;

class DaySixController extends Controller
{
    public function __invoke(DaySix $solver)
    {
        return [
            'puzzle_1' => $solver->puzzle1(),
            'puzzle_2' => $solver->puzzle2(),
        ];
    }
}
