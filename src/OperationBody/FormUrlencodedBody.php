<?php

declare (strict_types=1);

namespace Compwright\EasyApi\OperationBody;

use Compwright\EasyApi\OperationBodyInterface;

class FormUrlencodedBody implements OperationBodyInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(protected array $data)
    {
    }

    public function getContent(): string
    {
        return http_build_query($this->data);
    }

    public function getMimeType(): string
    {
        return 'application/x-www-form-urlencoded';
    }
}
