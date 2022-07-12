<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    private array $items;
    private array $legendary_items;
    private array $backstage_passess;
    private array $conjured_items;
    private array $other_special_items;
    private int $degrade_ratio;

    public function __construct(
        array $items,
        array $legendary_items = ['Sulfuras'],
        array $backstage_passess = ['Backstage pass'],
        array $conjured_items = ['Conjured'],
        array $other_special_items = ['Aged Brie']
    ) {
        $this->items = $items;
        $this->legendary_items = $legendary_items;
        $this->backstage_passess = $backstage_passess;
        $this->conjured_items = $conjured_items;
        $this->other_special_items = $other_special_items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->degrade_ratio = 1;
            //manage degrade ratio
            if ($item->sell_in <= 0) {
                $this->degrade_ratio *= 2;
            }

            // manage quality
            if ($this->item_contains($item->name, $this->other_special_items)) {
                $item->quality = $this->increaseQuality($item);
            } else if ($this->item_contains($item->name, $this->backstage_passess)) {
                $item->quality = $this->increaseQuality($item);
                if ($item->sell_in < 0) $item->quality = 0;
            } else if ($this->item_contains($item->name, $this->conjured_items)) {
                $item->quality = $this->decreaseQuality($item->quality, 2);
            } else if ($this->item_contains($item->name, $this->legendary_items)) {
                $item->quality = 80;
                // return;
            } else {
                $item->quality = $this->decreaseQuality($item->quality);
            }

            $item->sell_in -= 1;

            // check bounds
            if ($item->quality < 0) $item->quality = 0;
            if ($item->quality >= 50 && !$this->item_contains($item->name, $this->legendary_items)) $item->quality = 50;
        }
    }

    private function item_contains(string $needle, array $haystack): bool
    {
        foreach ($haystack as $item) {
            if (str_contains(strtolower($needle), strtolower($item))) {
                return true;
            }
        }

        return false;
    }

    private function increaseQuality(Item $item): int
    {
        if ($item->sell_in <= 5) {
            return $item->quality + 3;
        }
        if ($item->sell_in <= 10) {
            return $item->quality + 2;
        }

        return $item->quality;
    }

    private function decreaseQuality(int $quality, int $decrease = 1): int
    {
        return $quality - ($decrease * $this->degrade_ratio);
    }
}
