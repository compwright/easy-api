<?php

declare(strict_types=1);

namespace Compwright\EasyApi;

use InvalidArgumentException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OperationRequestFactory
{
    public function __construct(
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
        private Serializer\SerializerCollection $serializers
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function createRequest(Operation $op, ?string $contentType = null): RequestInterface
    {
        $request = $this->requestFactory->createRequest(
            $op->getMethod(),
            $op->getUri()
        );

        if ($op->hasQueryParams()) {
            $query = http_build_query($op->getQueryParams());
            $request = $request->withUri(
                $request->getUri()->withQuery($query)
            );
        }

        if ($op->hasBody()) {
            if (is_null($contentType) && !$this->serializers->hasDefaultSerializer()) {
                throw new InvalidArgumentException('No default serializer configured');
            }

            if ($contentType && !$this->serializers->hasSerializer($contentType)) {
                throw new InvalidArgumentException('No serializer configured for content type ' . $contentType);
            }

            $serializer = $contentType
                ? $this->serializers->getSerializer($contentType)
                : $this->serializers->getDefaultSerializer();

            $serializedBody = $serializer($op->getBody());
            $contentType = (string) $serializer;

            $stream = is_resource($serializedBody)
                ? $this->streamFactory->createStreamFromResource($serializedBody)
                // @phpstan-ignore-next-line argument.type
                : $this->streamFactory->createStream($serializedBody);

            $request = $request->withBody($stream)
                ->withHeader('Content-Type', $contentType);
        }

        return $request;
    }
}
