<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayThree;
use Tests\TestCase;

class DayThreeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('rucksack-compartments.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(157, app(DayThree::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(70, app(DayThree::class)->puzzle2());
    }
}
