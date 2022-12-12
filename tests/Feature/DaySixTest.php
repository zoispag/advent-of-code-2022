<?php

namespace Tests\Feature;

use App\Actions\Challenges\DaySix;
use Tests\TestCase;

class DaySixTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('communication-signal.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(10, app(DaySix::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(29, app(DaySix::class)->puzzle2());
    }
}
