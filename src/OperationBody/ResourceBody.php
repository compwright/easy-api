<?php

declare (strict_types=1);

namespace Compwright\EasyApi\OperationBody;

use Compwright\EasyApi\OperationBodyInterface;
use InvalidArgumentException;

class ResourceBody implements OperationBodyInterface
{
    /**
     * @param resource $data
     */
    public function __construct(protected $data, protected string $contentType)
    {
        if (!is_resource($data)) {
            throw new InvalidArgumentException('$data must be a resource');
        }
    }

    /**
     * @return resource
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
