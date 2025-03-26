<?php

namespace Compwright\EasyApi;

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
     */
    public function __invoke(Operation $op, Result\Result $result): Result\Result
    {
        $request = $this->requestFactory->createRequest($op);
        $response = $this->httpClient->sendRequest($request);
        $result->setResponse($response);
        return $result;
    }
}
