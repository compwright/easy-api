<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use Psr\Http\Message\ResponseInterface;

interface ResponseAwareInterface
{
    public function hasResponse(): bool;

    /**
     * @return static
     */
    public function setResponse(ResponseInterface $response): self;

    public function getResponse(): ResponseInterface;
}
