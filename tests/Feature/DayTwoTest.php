<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayTwo;
use Tests\TestCase;

class DayTwoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('rock-paper-scissors-strategy.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(15, app(DayTwo::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(12, app(DayTwo::class)->puzzle2());
    }
}
