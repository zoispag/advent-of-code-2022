<?php

namespace App\Actions\Challenges;

use App\KnotPosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Stringable;

/**
 * Day 9: Rope Bridge
 * https://adventofcode.com/2022/day/9
 */
class DayNine
{
    public function puzzle1(): int
    {
        $head = new KnotPosition(0, 0);
        $tail = new KnotPosition(0, 0);

        /** @var Collection $visitedByTail */
        $visitedByTail = $this->getFlatMoveList()
            ->reduce(function (Collection $visitedByTailCarry, string $direction) use (&$head, &$tail): Collection {
                // First move Head
                $head->move($direction);

                // Now move Tail
                $tail->follow($head);

                // Store the coordinates where tail stopped
                $visitedByTailCarry->push((string) $tail);

                return $visitedByTailCarry;
            }, collect());

        return $visitedByTail->unique()->count();
    }

    public function puzzle2(): int
    {
        $knots = collect()->times(10, fn () => new KnotPosition(0, 0));

        /** @var Collection $visitedByTail */
        $visitedByTail = $this->getFlatMoveList()
            ->reduce(function (Collection $visitedByTailCarry, string $direction) use ($knots): Collection {
                // First move Head
                $knots->first()->move($direction);

                // Move rest of knots
                $knots->slice(1)
                    ->each(fn ($knot, $index) => $knot->follow($knots[$index - 1]));

                // Store the coordinates where tail stopped
                $visitedByTailCarry->push((string) $knots->last());

                return $visitedByTailCarry;
            }, collect());

        return $visitedByTail->unique()->count();
    }

    private function getFlatMoveList(): Collection
    {
        $input = Storage::disk('resources')->get('rope-movements.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter()
            ->mapInto(Stringable::class)
            ->flatMap(fn (Stringable $line) => collect()->times(
                $line->after(' ')->toInteger(),
                fn () => $line->before(' ')->toString()
            ));
    }
}
