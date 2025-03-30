<?php

declare (strict_types=1);

namespace Compwright\EasyApi;

interface OperationBodyInterface
{
    /**
     * @return string|resource
     */
    public function getContent();

    public function getMimeType(): string;
}
