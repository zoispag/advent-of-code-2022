<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayFive;
use Tests\TestCase;

class DayFiveTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('cargo-crane.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals('CMZ', app(DayFive::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals('MCD', app(DayFive::class)->puzzle2());
    }
}
