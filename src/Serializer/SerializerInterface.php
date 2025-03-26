<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Serializer;

use Stringable;

interface SerializerInterface extends Stringable
{
    /**
     * @return string|resource
     */
    public function __invoke(mixed $data);
}
