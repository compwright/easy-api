<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Serializer;

final class FormUrlencodedSerializer implements SerializerInterface
{
    public function __toString(): string
    {
        return 'application/x-www-form-urlencoded';
    }

    public function __invoke(mixed $data): string
    {
        return http_build_query((array) $data);
    }
}
