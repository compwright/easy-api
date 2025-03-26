<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use ArrayIterator;
use IteratorAggregate;

trait IterableResultTrait
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getArray(): array
    {
        $data = (array) $this->data();
        /** @var array<int, array<string, mixed>> */
        $data = $data[$this->key] ?? [];
        return $data;
    }

    public function count(): int
    {
        return count($this->getArray());
    }

    // @phpstan-ignore-next-line missingType.generics
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(
            $this->getArray()
        );
    }
}
