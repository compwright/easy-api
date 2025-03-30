<?php

declare(strict_types=1);

namespace Compwright\EasyApi;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

class ApiException extends RuntimeException implements ClientExceptionInterface
{
    private RequestInterface $request;

    private ResponseInterface $response;

    public static function isError(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 400;
    }

    public static function new(RequestInterface $request, ResponseInterface $response, ?Throwable $previous = null): self
    {
        $message = sprintf(
            '%s %s failed: HTTP %d %s',
            $request->getMethod(),
            (string) $request->getUri(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        $code = $response->getStatusCode();

        return (new self($message, $code, $previous))
            ->setRequest($request)
            ->setResponse($response);
    }

    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request ?? null;
    }

    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response ?? null;
    }
}
