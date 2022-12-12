<?php

namespace App;

enum RPS
{
    case Rock;
    case Paper;
    case Scissor;

    public function points(): int
    {
        return match ($this) {
            self::Rock => 1,
            self::Paper => 2,
            self::Scissor => 3,
        };
    }

    public function drawsWith(RPS $opponent): bool
    {
        return $this === $opponent;
    }

    public function winsAgainst(RPS $opponent): bool
    {
        return $opponent === $this->winningGesture();
    }

    public function losesAgainst(RPS $opponent): bool
    {
        return $opponent === $this->losingGesture();
    }

    public function winningGesture(): RPS
    {
        return match ($this) {
            self::Rock => self::Scissor,
            self::Paper => self::Rock,
            self::Scissor => self::Paper,
        };
    }

    public function losingGesture(): RPS
    {
        return match ($this) {
            self::Rock => self::Paper,
            self::Paper => self::Scissor,
            self::Scissor => self::Rock,
        };
    }
}
