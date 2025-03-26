<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Serializer;

use Countable;
use JsonSerializable;

class SerializerCollection implements Countable, JsonSerializable
{
    private string $defaultSerializer;

    /**
     * @var array<string, SerializerInterface>
     */
    private array $serializers = [];

    public static function default(): self
    {
        return (new self())
            ->addSerializer(
                new TextSerializer(),
                new FormUrlencodedSerializer(),
                new JsonSerializer()
            )
            ->setDefaultSerializer('text/plain');
    }

    public function count(): int
    {
        return count($this->serializers);
    }

    public function jsonSerialize(): mixed
    {
        return array_keys($this->serializers);
    }

    public function hasSerializer(string $contentType): bool
    {
        return array_key_exists($contentType, $this->serializers);
    }

    public function getSerializer(string $contentType): SerializerInterface
    {
        return $this->serializers[$contentType];
    }

    public function addSerializer(SerializerInterface ...$serializer): self
    {
        foreach ($serializer as $s) {
            $this->serializers[(string) $s] = $s;
        }
        return $this;
    }

    public function hasDefaultSerializer(): bool
    {
        return isset($this->defaultSerializer) && $this->hasSerializer($this->defaultSerializer);
    }

    public function getDefaultSerializer(): SerializerInterface
    {
        return $this->getSerializer($this->defaultSerializer);
    }

    public function setDefaultSerializer(string $contentType): self
    {
        $this->defaultSerializer = $contentType;
        return $this;
    }
}
