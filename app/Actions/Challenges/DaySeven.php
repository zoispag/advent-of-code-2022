<?php

namespace App\Actions\Challenges;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Day 7: No Space Left On Device
 * https://adventofcode.com/2022/day/7
 */
class DaySeven
{
    public function puzzle1(): int
    {
        return collect($this->buildDirsWithSizes())
            ->filter(fn ($s) => $s <= 100000)
            ->sum();
    }

    public function puzzle2(): int
    {
        $diskSize = 70000000;
        $requiredForUpdate = 30000000;

        $dirs = $this->buildDirsWithSizes();
        $available = $diskSize - $dirs['/'];
        $required = $requiredForUpdate - $available;

        return collect($dirs)
            ->sort()
            ->reject(fn ($size) => $size < $required)
            ->first();
    }

    private function getBashHistory(): Collection
    {
        $input = Storage::disk('resources')->get('bash-history.txt');

        return str($input)
            ->explode(PHP_EOL)
            ->filter();
    }

    private function buildDirsWithSizes(): array
    {
        $cwd = collect([]);
        $directories = [];
        $traverseComplete = [];

        $this->getBashHistory()
            ->each(function ($stdout) use (&$cwd, &$directories, &$traverseComplete) {
                // List
                if ($stdout === '$ ls') {
                    return;
                }

                // Change directory
                if (str_starts_with($stdout, '$ cd')) {
                    $dir = str($stdout)->after('$ cd ')->toString();

                    if ($dir === '..') {
                        $cwd->pop();
                    } else {
                        $cwd->push($dir);
                    }

                    return;
                }

                // Directory
                if (str_starts_with($stdout, 'dir')) {
                    return;
                }

                // File
                [$size, $name] = str($stdout)->explode(' ');

                $fullPath = $cwd->join('/') . "/{$name}";
                if (in_array($fullPath, $traverseComplete)) {
                    return;
                }

                $partial = '';
                foreach ($cwd as $dir) {
                    $partial .= $dir !== '/' ? "{$dir}/" : '/';
                    if (! array_key_exists($partial, $directories)) {
                        $directories[$partial] = 0;
                    }
                    $directories[$partial] += (int) $size;
                }

                $traverseComplete[] = $fullPath;
            });

        return $directories;
    }
}
