<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayTen;
use Tests\TestCase;

class DayTenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('cpu-instructions.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(13140, app(DayTen::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $crt = <<<HERE
        ##..##..##..##..##..##..##..##..##..##..
        ###...###...###...###...###...###...###.
        ####....####....####....####....####....
        #####.....#####.....#####.....#####.....
        ######......######......######......####
        #######.......#######.......#######.....
        HERE;

        $this->assertEquals($crt, app(DayTen::class)->puzzle2());
    }
}
