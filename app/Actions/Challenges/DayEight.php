<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 8: Treetop Tree House
 * https://adventofcode.com/2022/day/8
 */
class DayEight
{
    public function puzzle1() :int
    {
        $forest = $this->getForest();
        $transposed = $forest->transpose();
        $size = $forest->count();

        return $forest->map(fn ($rowOfTrees, $x) => collect($rowOfTrees)
            ->map(function (int $tree, $y) use ($x, $size, $transposed, $rowOfTrees): int {
                // Sides are always visible
                if ($x === 0 || $y === 0 || $x === $size - 1 || $y === $size - 1) {
                    return 1;
                }

                /** @var Collection $columnOfTrees */
                $columnOfTrees = $transposed->get($y);

                // Find the highest trees left or right in row and above or below in column
                $maxLeft = (int) collect($rowOfTrees)->take($y)->max();
                $maxRight = (int) collect($rowOfTrees)->slice($y + 1)->max();
                $maxUp = (int) $columnOfTrees->take($x)->max();
                $maxDown = (int) $columnOfTrees->slice($x + 1)->max();

                return ($maxLeft < $tree || $maxRight < $tree || $maxUp < $tree || $maxDown < $tree);
            })->sum()
        )->sum();
    }

    public function puzzle2(): int
    {
        $transposed = $this->getForest()->transpose();

        return $this->getForest()->map(fn ($rowOfTrees, $x) => $rowOfTrees
            ->map(function ($tree, $y) use ($rowOfTrees, $x, $transposed) {
                /** @var Collection $columnOfTrees */
                $columnOfTrees = $transposed->get($y);
                $rowOfTrees = collect($rowOfTrees);

                $left = $rowOfTrees->take($y)->reverse();
                $right = $rowOfTrees->slice($y + 1);
                $up = $columnOfTrees->take($x)->reverse();
                $down = $columnOfTrees->slice($x + 1);

                // Find the number of visible trees between current tree and next visible and calculate
                // the scenic score by multiplying the number of visible trees in each direction
                return collect([$left, $right, $up, $down])
                    ->map(fn (Collection $direction) =>
                        $direction->filter(fn (int $lookupTree) => $lookupTree >= $tree)->count() === 0
                            ? $direction->count()
                            : $direction->takeUntil(fn (int $lookupTree) => $lookupTree >= $tree)->count() + 1
                    )->reduce(fn ($scenicScore, $treeCount) => $scenicScore * $treeCount, 1);
            })->max()
        )->max();
    }

    private function getForest(): Collection
    {
        $input = Storage::disk('resources')->get('tree-forest.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter()
            ->map(fn (string $row) => collect(str_split($row))->map(fn ($tree) => intval($tree)));
    }
}
