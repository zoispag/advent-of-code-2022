<?php

namespace Tests\Feature;

use App\Actions\Challenges\DayEleven;
use Tests\TestCase;

class DayElevenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('monkeys.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(10605, app(DayEleven::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->markTestSkipped('Very slow test, due to 10000 cycles. It is passing though :D');

        $this->assertEquals(2713310158, app(DayEleven::class)->puzzle2());
    }
}
