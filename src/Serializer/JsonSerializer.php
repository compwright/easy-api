<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Serializer;

use JsonException;

final class JsonSerializer implements SerializerInterface
{
    public function __toString(): string
    {
        return 'application/json';
    }

    /**
     * @throws JsonException
     */
    public function __invoke(mixed $body): string
    {
        return json_encode($body, JSON_THROW_ON_ERROR, 512);
    }
}
