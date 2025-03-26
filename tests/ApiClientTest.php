<?php

namespace Compwright\EasyApi;

use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class ApiClientTest extends TestCase
{
    public function testInvoke(): void
    {
        $response = $this->createStub(ResponseInterface::class);

        $mockClient = $this->createMock(ClientInterface::class);
        $mockClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                $this->callback(function (Request $request) {
                    return '/foo' === (string) $request->getUri();
                })
            )
            ->willReturn($response);

        $httpFactory = new HttpFactory();
        $serializers = Serializer\SerializerCollection::default();
        $requestFactory = new OperationRequestFactory($httpFactory, $httpFactory, $serializers);

        $api = new ApiClient($mockClient, $requestFactory);

        $result = $api(
            Operation::fromSpec('GET /foo'),
            new Result\Result()
        );

        $this->assertSame($response, $result->getResponse());
    }
}
