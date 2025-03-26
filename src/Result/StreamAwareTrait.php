<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use Psr\Http\Message\StreamInterface;

trait StreamAwareTrait
{
    use ResponseAwareTrait;

    public function stream(): StreamInterface
    {
        return $this->getResponse()->getBody();
    }
}
