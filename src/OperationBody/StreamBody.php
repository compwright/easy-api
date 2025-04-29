<?php

declare (strict_types=1);

namespace Compwright\EasyApi\OperationBody;

use Compwright\EasyApi\OperationBodyInterface;
use Psr\Http\Message\StreamInterface;

class StreamBody implements OperationBodyInterface
{
    public function __construct(protected StreamInterface $data, protected string $contentType)
    {
    }

    /**
     * @return StreamInterface
     */
    public function getContent()
    {
        return $this->data;
    }

    public function getMimeType(): string
    {
        return $this->contentType;
    }
}
