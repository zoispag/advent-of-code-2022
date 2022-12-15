<?php

namespace App;

use Illuminate\Support\Facades\Log;

class Monkey
{
    public int $inspectionCounts = 0;

    public function __construct(
        public readonly int $id,
        public readonly \Closure $itemInspectOperation,
        public readonly \Closure $stressRelieveOperation,
        public readonly \Closure $itemThrowingDecision,
        public array $items,
    ) {
    }

    public function printItems(): string
    {
        return collect($this->items)->join(', ');
    }

    public function hasItems(): bool
    {
        return ! empty($this->items);
    }

    public function throwItem(): array
    {
        $this->inspectionCounts++;
        // Get worry level of first item
        $itemWorryLevel = array_shift($this->items);
        Log::debug("    Monkey inspects an item with a worry level of {$itemWorryLevel}.");

        // Inspect item and adjust worry level
        $currentWorryLevel = ($this->itemInspectOperation)($itemWorryLevel);
        Log::debug("      Worry level increases/is multiplied to {$currentWorryLevel}.");

        $relievedWorry = ($this->stressRelieveOperation)($currentWorryLevel);
        Log::debug("      Monkey gets bored with item. Worry level is divided down to {$relievedWorry}.");

        // Decide which monkey will receive the item
        $receiverMonkey = ($this->itemThrowingDecision)($relievedWorry);
        Log::debug("      Item with worry level {$relievedWorry} is thrown to monkey {$receiverMonkey}.");

        return ['monkey' => $receiverMonkey, 'item' => $relievedWorry];
    }

    public function receiveItem(int $itemId): void
    {
        $this->items[] = $itemId;
    }
}
