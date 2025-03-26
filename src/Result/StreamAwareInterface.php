<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use Psr\Http\Message\StreamInterface;

interface StreamAwareInterface
{
    public function stream(): StreamInterface;
}
