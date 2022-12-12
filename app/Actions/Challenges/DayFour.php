<?php

namespace App\Actions\Challenges;

use App\RPS;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 4: Camp Cleanup
 * https://adventofcode.com/2022/day/4
 */
class DayFour
{
    public function puzzle1(): int
    {
        return $this->getAssignmentPairs()
            ->filter(function ($pair) {
                [$left1, $right1, $left2, $right2] = $pair;

                if ($left1 >= $left2 && $right1 <= $right2) {
                    return true;
                }

                if ($left2 >= $left1 && $right2 <= $right1) {
                    return true;
                }

                return false;
            })->count();
    }

    public function puzzle2(): int
    {
        return $this->getAssignmentPairs()
            ->reject(function ($pair) {
                [$left1, $right1, $left2, $right2] = $pair;

                return $right1 < $left2 || $left1 > $right2;
            })->count();
    }

    private function getAssignmentPairs(): Collection
    {
        $input = Storage::disk('resources')->get('assignment-pairs.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter()
            ->map(fn ($pair) => str($pair)->explode(',')
                ->map(fn($section) => str($section)->explode('-'))
                ->flatten()
            );
    }
}
