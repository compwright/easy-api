<?php

declare (strict_types=1);

namespace Compwright\EasyApi\OperationBody;

use Compwright\EasyApi\OperationBodyInterface;
use JsonException;

class JsonBody implements OperationBodyInterface
{
    /**
     * @param mixed $data
     */
    public function __construct(protected $data)
    {
    }

    /**
     * @throws JsonException
     */
    public function getContent(): string
    {
        return \json_encode($this->data, JSON_THROW_ON_ERROR);
    }

    public function getMimeType(): string
    {
        return 'application/json';
    }
}
