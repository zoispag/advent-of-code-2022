<?php

namespace App\Actions\Challenges;

use App\Monkey;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Day 11: Monkey in the Middle
 * https://adventofcode.com/2022/day/11
 */
class DayEleven
{
    private int $superModulo;

    public function puzzle1(): int
    {
        return $this->monkeyKeepAway(20, false);
    }

    public function puzzle2(): int
    {
        set_time_limit(0);

        return $this->monkeyKeepAway(10000, true);
    }

    private function monkeyKeepAway(int $rounds, bool $panicMode)
    {
        $round = 0;

        $monkeys = $this->initMonkeys($panicMode);
        $itemsInspectedPerMonkey = collect([]);

        while (true) {
            $round++;
            Log::debug("Round {$round}:");
            $monkeys->each(function (Monkey $monkey) use ($monkeys) {
                Log::debug("  Monkey {$monkey->id}:");
                while ($monkey->hasItems()) {
                    ['monkey' => $receiverMonkeyId, 'item' => $thrownItem] = $monkey->throwItem();

                    /** @var Monkey $receiver */
                    $receiver = $monkeys[$receiverMonkeyId];
                    $receiver->receiveItem($thrownItem);
                }
            });

            Log::debug("");
            Log::debug("After round {$round}, the monkeys are holding items with these worry levels:");
            $monkeys->each(fn (Monkey $monkey) => Log::debug("Monkey {$monkey->id}: {$monkey->printItems()}"));
            Log::debug("");

            $monkeys->each(function (Monkey $monkey) use ($itemsInspectedPerMonkey) {
                  $itemsInspectedPerMonkey[$monkey->id] =+ $monkey->inspectionCounts;
            });

            if ($round === $rounds) {
                break;
            }
        }

        return $itemsInspectedPerMonkey->sortDesc()->take(2)->reduce(fn ($carry, $i) => $carry * $i, 1);
    }

    private function initMonkeys(bool $panicMode = false): Collection
    {
        $input = Storage::disk('resources')->get('monkeys.txt');

        $this->superModulo = $this->getSuperModulo($input);

        return str($input)
            ->explode(PHP_EOL . PHP_EOL)
            ->map(fn (string $monkeyInit) => $this->parseMonkey($monkeyInit, $panicMode));
    }

    private function getSuperModulo(string $input): int
    {
        return str($input)
            ->explode(PHP_EOL . PHP_EOL)
            ->map(fn (string $monkeyInit) => str($monkeyInit)->betweenFirst('divisible by ', PHP_EOL)->toInteger())
            ->reduce(fn ($carry, $divisor) => $carry * $divisor, 1);
    }

    private function parseMonkey(string $monkeyInit, bool $panicMode): Monkey
    {
        $id = str($monkeyInit)->betweenFirst('Monkey', ':')->trim()->toInteger();
        $items = str($monkeyInit)->betweenFirst('Starting items: ', PHP_EOL)->explode(', ')->map(fn ($item) => intval($item))->toArray();
        [$operator, $factor] = str($monkeyInit)->betweenFirst('Operation: ', PHP_EOL)->after('new = old ')->explode(' ');
        $itemInspectOperation = function (int $item) use ($operator, $factor) {
            if ($factor === 'old') {
                $factor = $item;
            }

            return match($operator) {
                '*' => $item * (int) $factor,
                '+' => $item + (int) $factor,
            };
        };
        $stressRelieveOperation = function (int $worryLevel) use ($panicMode) {
            if ($panicMode) {
                return $worryLevel % $this->superModulo;
            }

            return floor($worryLevel / 3);
        };
        $mod = str($monkeyInit)->betweenFirst('divisible by ', PHP_EOL)->toInteger();
        $modTrue = str($monkeyInit)->betweenFirst('If true: throw to monkey ', PHP_EOL)->toInteger();
        $modFalse = str($monkeyInit)->betweenFirst('If false: throw to monkey ', PHP_EOL)->toInteger();
        $itemThrowingDecision = function (int $worryLevel) use ($mod, $modTrue, $modFalse) {
            return $worryLevel % $mod === 0 ? $modTrue : $modFalse;
        };

        return new Monkey(
            $id,
            $itemInspectOperation,
            $stressRelieveOperation,
            $itemThrowingDecision,
            $items,
        );
    }
}
