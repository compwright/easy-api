<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

use Psr\Http\Message\ResponseInterface;

trait ResponseAwareTrait
{
    protected ResponseInterface $response;

    public function hasResponse(): bool
    {
        return isset($this->response);
    }

    /**
     * @return static
     */
    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
