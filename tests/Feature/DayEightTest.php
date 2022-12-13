<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayEight;
use Tests\TestCase;

class DayEightTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('tree-forest.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(21, app(DayEight::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(8, app(DayEight::class)->puzzle2());
    }
}
