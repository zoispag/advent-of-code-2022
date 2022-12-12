<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayOne;
use Tests\TestCase;

class DayOneTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('elf-calories.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(24000, app(DayOne::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(45000, app(DayOne::class)->puzzle2());
    }
}
