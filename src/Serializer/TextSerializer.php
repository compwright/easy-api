<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Serializer;

use JsonException;

final class TextSerializer implements SerializerInterface
{
    public function __toString(): string
    {
        return 'text/plain';
    }

    /**
     * @throws JsonException
     */
    public function __invoke(mixed $body): string
    {
        // @phpstan-ignore-next-line argument.type
        return strval($body);
    }
}
