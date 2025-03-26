<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result\Json;

use Compwright\EasyApi\Result\IterableResultInterface;
use Compwright\EasyApi\Result\IterableResultTrait;

class IterableResult extends Result implements IterableResultInterface
{
    use IterableResultTrait;
}
