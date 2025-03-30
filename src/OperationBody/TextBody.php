<?php

declare (strict_types=1);

namespace Compwright\EasyApi\OperationBody;

use Compwright\EasyApi\OperationBodyInterface;

class TextBody implements OperationBodyInterface
{
    public function __construct(protected string $data)
    {
    }

    public function getContent(): string
    {
        return $this->data;
    }

    public function getMimeType(): string
    {
        return 'text/plain';
    }
}
