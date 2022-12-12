<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function swapInputWith(string $name, string $file): void
    {
        Storage::fake('resources');
        Storage::disk('resources')->put(
            $name,
            File::get(base_path("tests/Fixtures/{$file}")),
        );
    }

    protected function swapInput(string $name): void
    {
        $this->swapInputWith($name, $name);
    }
}
