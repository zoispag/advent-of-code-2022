<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayNine;
use Tests\TestCase;

class DayNineTest extends TestCase
{
    /** @test */
    public function puzzle_1()
    {
        $this->swapInputWith('rope-movements.txt', 'rope-movements_1.txt');
        $this->assertEquals(13, app(DayNine::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->swapInputWith('rope-movements.txt', 'rope-movements_2.txt');
        $this->assertEquals(36, app(DayNine::class)->puzzle2());
    }
}
