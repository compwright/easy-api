<?php

namespace Compwright\EasyApi;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class ApiClient
{
    public function __construct(
        private ClientInterface $httpClient,
        private OperationRequestFactory $requestFactory
    ) {
    }

    /**
     * @template T of Result\Result
     * @param T $result
     * @return T
     *
     * @throws ApiException|ClientExceptionInterface
     */
    public function __invoke(Operation $op, Result\Result $result): Result\Result
    {
        try {
            $request = $this->requestFactory->createRequest($op);
            $response = $this->httpClient->sendRequest($request);
            $result->setResponse($response);
            if (ApiException::isError($response)) {
                throw ApiException::new($request, $response);
            }
            return $result;
        } catch (ClientExceptionInterface $e) {
            throw $e;
        } finally {
            if (isset($response)) {
                $result->setResponse($response);
            }
        }
    }
}
