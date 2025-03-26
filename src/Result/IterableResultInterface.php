<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use Countable;
use IteratorAggregate;

// @phpstan-ignore-next-line missingType.generics
interface IterableResultInterface extends Countable, IteratorAggregate
{
    public function __construct(string $key);
}
