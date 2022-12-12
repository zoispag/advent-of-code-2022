<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Facades\Storage;

/**
 * Day 6: Tuning Trouble
 * https://adventofcode.com/2022/day/6
 */
class DaySix
{
    public function puzzle1(): int
    {
        return $this->findNthUniqueSignal(4);
    }

    public function puzzle2(): int
    {
        return $this->findNthUniqueSignal(14);
    }

    private function findNthUniqueSignal(int $nth): int
    {
        $input = Storage::disk('resources')->get('communication-signal.txt');

        $letters = collect(str_split(str($input)->trim()));

        for ($i = $nth; $i < $letters->count(); $i++) {
            $signal = $letters->slice($i - $nth, $nth);

            if (collect($signal)->duplicates()->isEmpty()) {
                return $i;
            }
        }

        return 0;
    }
}
