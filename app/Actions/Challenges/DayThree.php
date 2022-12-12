<?php

namespace App\Actions\Challenges;

use App\RPS;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 3: Rucksack Reorganization
 * https://adventofcode.com/2022/day/3
 */
class DayThree
{
    public function puzzle1(): int
    {
        return $this->getCompartments()
            ->map(fn ($rucksack) => collect(str_split($rucksack))
                ->chunk(ceil(strlen($rucksack) / 2))
                ->map(fn (Collection $compartment) => $compartment->unique())
                ->flatten()
                ->duplicatesStrict()
                ->first()
            )->sum(fn ($letter) => $this->prioritizeLetter($letter));
    }

    public function puzzle2(): int
    {
        return $this->getCompartments()
            ->chunk(3)
            ->map(function (Collection $group) {
                [$r1, $r2, $r3] = $group->values()->map(fn ($rucksack) => collect(str_split($rucksack)));

                return $r1->intersect($r2)->intersect($r3)->first();
            })->sum(fn ($letter) => $this->prioritizeLetter($letter));
    }

    private function getCompartments(): Collection
    {
        $input = Storage::disk('resources')->get('rucksack-compartments.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter();
    }

    private function prioritizeLetter(string $letter): int
    {
        return str($letter)->lower()->is($letter)
            ? ord($letter) - 96 // ord('a') = 97 & a has priority 1
            : ord($letter) - 38; // ord('A') = 65 & A has priority 27
    }
}
