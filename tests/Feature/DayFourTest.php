<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayFour;
use Tests\TestCase;

class DayFourTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('assignment-pairs.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(2, app(DayFour::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(4, app(DayFour::class)->puzzle2());
    }
}
