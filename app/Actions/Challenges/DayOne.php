<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 1: Calorie Counting
 * https://adventofcode.com/2022/day/1
 */
class DayOne
{
    public function puzzle1(): int
    {
        return $this->sortedCaloriesGroups()
            ->max();
    }

    public function puzzle2(): int
    {
        return $this->sortedCaloriesGroups()
            ->sortDesc()
            ->take(3)
            ->sum();
    }

    private function sortedCaloriesGroups(): Collection
    {
        $input = Storage::disk('resources')->get('elf-calories.txt');

        return str($input)
            ->explode(PHP_EOL . PHP_EOL)
            ->map(fn (string $elf) => str($elf)
                ->explode(PHP_EOL)
                ->map(fn (string $calories) => (int) $calories)
                ->sum()
            );
    }
}
