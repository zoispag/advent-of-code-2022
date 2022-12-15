<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 10: Cathode-Ray Tube
 * https://adventofcode.com/2022/day/10
 */
class DayTen
{
    public function puzzle1(): int
    {
        $cpuInstructions = $this->getCpuInstructions();

        return collect([20, 60, 100, 140, 180, 220])
            ->map(fn ($cycle) => $cpuInstructions->take($cycle - 1)->reduce(fn ($carry, $i) => $carry + $i, 1) * $cycle)
            ->sum();
    }

    public function puzzle2(): string
    {
        return $this->getCpuInstructions()
            ->reduce(fn (Collection $carry, $i) => $carry->push($carry->last() + $i), collect([0]))
            ->map(fn ($spriteMiddle, $cycle) => abs($spriteMiddle - ($cycle % 40 - 1)) <= 1 ? '#' : '.')
            ->take(40 * 6)
            ->chunk(40)
            ->map(fn ($row) => $row->join(''))
            ->join(PHP_EOL);
    }

    private function getCpuInstructions(): Collection
    {
        $input = Storage::disk('resources')->get('cpu-instructions.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter()
            ->flatMap(fn ($instruction) => str($instruction)->trim()->is('noop')
                ? [0]
                : [0, str($instruction)->after(' ')->toInteger()]
            );
    }
}
