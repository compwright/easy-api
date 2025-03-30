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
        private StreamFactoryInterface $streamFactory
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function createRequest(Operation $op): RequestInterface
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
            $bodyContent = $op->getBody()->getContent();
            if (is_resource($bodyContent)) {
                $stream = $this->streamFactory->createStreamFromResource($bodyContent);
            } elseif (is_string($bodyContent)) {
                $stream = $this->streamFactory->createStream($bodyContent);
            } else {
                throw new InvalidArgumentException('Operation body data must be a string or resource');
            }
            $request = $request->withBody($stream)
                ->withHeader('Content-Type', $op->getBody()->getMimeType());
        }

        return $request;
    }
}
