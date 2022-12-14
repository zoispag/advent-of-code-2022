<?php

namespace App;

use Stringable;

class KnotPosition implements Stringable
{
    public function __construct(
        private int $x,
        private int $y,
    ) {}

    public function __toString(): string
    {
        return "[{$this->x},{$this->y}]";
    }

    public function move(string $direction): void
    {
        match ($direction) {
            'L' => $this->x--,
            'R' => $this->x++,
            'U' => $this->y--,
            'D' => $this->y++,
        };
    }

    public function follow(self $head): void
    {
        if ($this->is($head)) {
            return;
        }

        if ($this->isAdjacent($head)) {
            return;
        }

        // Move horizontal
        // 1. [ ][ ][ ]  | 2. [ ][ ][ ] | 3. [ ][ ][ ]
        //    [T][H][ ]  |    [T][ ][H] |    [ ][T][H]
        //    [ ][ ][ ]  |    [ ][ ][ ] |    [ ][ ][ ]
        if ($head->x === $this->x) {
            $this->y = $head->y > $this->y ? $this->y + 1 : $this->y - 1;
            return;
        }

        // Move vertical
        // 1. [T][ ][ ]  | 2. [T][ ][ ] | 3. [ ][ ][ ]
        //    [H][ ][ ]  |    [ ][ ][ ] |    [T][ ][ ]
        //    [ ][ ][ ]  |    [H][ ][ ] |    [H][ ][ ]
        if ($head->y === $this->y) {
            $this->x = $head->x > $this->x ? $this->x + 1 : $this->x - 1;
            return;
        }

        // Move diagonally
        // 1. [ ][ ][ ]  | 2. [ ][ ][Η] | 3. [ ][ ][Η]
        //    [ ][ ][Η]  |    [ ][ ][ ] |    [ ][ ][Τ]
        //    [ ][Τ][ ]  |    [ ][Τ][ ] |    [ ][ ][ ]
        $diagonalMovements = [
            'UR' => ['x' => 1, 'y' => -1],
            'DR' => ['x' => 1, 'y' => 1],
            'UL' => ['x' => -1, 'y' => -1],
            'DL' => ['x' => -1, 'y' => 1],
        ];
        while (count($diagonalMovements)) {
            ['x' => $xMove, 'y' => $yMove] = array_pop($diagonalMovements);
            $originalTailPosition = $this->backupPosition();

            $this->x += $xMove;
            $this->y += $yMove;

            if ($this->isAdjacent($head)) {
                return;
            }

            $this->resetPosition($originalTailPosition);
        }
    }

    private function is(KnotPosition $another): bool
    {
        return $this->x === $another->x && $this->y === $another->y;
    }

    private function isAdjacent(KnotPosition $another): bool
    {
        return max(
            abs($this->x - $another->x),
            abs($this->y - $another->y),
        ) === 1;
    }

    private function backupPosition(): self
    {
        return clone($this);
    }

    private function resetPosition(KnotPosition $restore): void
    {
        $this->x = $restore->x;
        $this->y = $restore->y;
    }
}
