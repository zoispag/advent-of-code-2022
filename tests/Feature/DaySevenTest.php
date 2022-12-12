<?php

namespace Tests\Feature;

use App\Actions\Challenges\DaySeven;
use Tests\TestCase;

class DaySevenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swapInput('bash-history.txt');
    }

    /** @test */
    public function puzzle_1()
    {
        $this->assertEquals(95437, app(DaySeven::class)->puzzle1());
    }

    /** @test */
    public function puzzle_2()
    {
        $this->assertEquals(24933642, app(DaySeven::class)->puzzle2());
    }
}
