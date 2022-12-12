<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 5: Supply Stacks
 * https://adventofcode.com/2022/day/5
 */
class DayFive
{
    public function puzzle1(): string
    {
        [$stackBlueprint, $procedureStepsBlueprint] = $this->getBlueprints();

        $stacks = $this->getCargoStacks($stackBlueprint);
        $this->getProcedureSteps($procedureStepsBlueprint)
            ->each(function ($step) use (&$stacks) {
                [$quantity, $origin, $destination] = $step;

                foreach (range(1, $quantity) as $ignored) {
                    array_unshift($stacks[$destination], array_shift($stacks[$origin]));
                }
            });

        return collect($stacks)
            ->map(fn ($stack) => $stack[0])
            ->join('');
    }

    public function puzzle2(): string
    {
        [$stackBlueprint, $procedureStepsBlueprint] = $this->getBlueprints();

        $stacks = $this->getCargoStacks($stackBlueprint);
        $this->getProcedureSteps($procedureStepsBlueprint)
            ->each(function ($step) use (&$stacks) {
                [$quantity, $origin, $destination] = $step;

                $movedCrates = collect([]);
                foreach (range(1, $quantity) as $ignored) {
                    $movedCrates->push(array_shift($stacks[$origin]));
                }

                foreach ($movedCrates->reverse() as $crate) {
                    array_unshift($stacks[$destination], $crate);
                }
            });

        return collect($stacks)
            ->map(fn ($stack) => $stack[0])
            ->join('');
    }

    private function getBlueprints(): Collection
    {
        $input = Storage::disk('resources')->get('cargo-crane.txt');

        return str($input)->explode(PHP_EOL . PHP_EOL);
    }

    private function getCargoStacks(string $stackBlueprint): array
    {
        $stacks = [];

        collect(str($stackBlueprint)->explode(PHP_EOL))
            ->reverse()
            ->slice(1)
            ->reverse()
            ->each(function ($row) use (&$stacks) {
                collect(str_split($row))
                    ->chunk(4)
                    ->each(function ($chuck, $stackId) use (&$stacks) {
                        $cargo = trim($chuck->values()[1]);

                        if (! $cargo) {
                            return;
                        }

                        $stacks[$stackId][] = $cargo;
                    });
            });

        ksort($stacks);

        return $stacks;
    }

    private function getProcedureSteps(string $procedureStepsBlueprint): Collection
    {
        return str($procedureStepsBlueprint)
            ->explode(PHP_EOL)
            ->filter()
            ->map(function ($step) use (&$stacks) {
                $quantity = str($step)->between('move ', ' from')->toInteger();
                $origin = str($step)->between('from ', ' to')->toInteger() - 1;
                $destination = str($step)->after('to ')->toInteger() - 1;

                return [$quantity, $origin, $destination];
            });
    }
}
