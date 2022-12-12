<?php

namespace App\Actions\Challenges;

use App\RPS;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 2: Rock Paper Scissors
 * https://adventofcode.com/2022/day/2
 */
class DayTwo
{
    public function puzzle1(): int
    {
        return $this->getRounds()
            ->map(function ($round) {
                [$h1, $h2] = $round;
                $opponent = match ($h1) {
                    'A' => RPS::Rock,
                    'B' => RPS::Paper,
                    'C' => RPS::Scissor,
                };
                $me = match ($h2) {
                    'X' => RPS::Rock,
                    'Y' => RPS::Paper,
                    'Z' => RPS::Scissor,
                };
                $pointsFromRound = match (true) {
                    $me->drawsWith($opponent) => 3,
                    $me->winsAgainst($opponent) => 6,
                    $me->losesAgainst($opponent) => 0,
                };

                return $me->points() + $pointsFromRound;
            })
            ->sum();
    }

    public function puzzle2(): int
    {
        return $this->getRounds()
            ->map(function ($round) {
                [$h1, $h2] = $round;
                $opponent = match ($h1) {
                    'A' => RPS::Rock,
                    'B' => RPS::Paper,
                    'C' => RPS::Scissor,
                };
                $me = match ($h2) {
                    'X' => $opponent->winningGesture(), // lose
                    'Y' => $opponent,                   // draw
                    'Z' => $opponent->losingGesture(),  // win
                };
                $pointsFromRound = match (true) {
                    $me->drawsWith($opponent) => 3,
                    $me->winsAgainst($opponent) => 6,
                    $me->losesAgainst($opponent) => 0,
                };

                return $me->points() + $pointsFromRound;
            })
            ->sum();
    }

    private function getRounds(): Collection
    {
        $input = Storage::disk('resources')->get('rock-paper-scissors-strategy.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter()
            ->map(function ($round) {
                [$h1, $h2] = str($round)->explode(' ');

                return [$h1, $h2];
            });
    }
}
