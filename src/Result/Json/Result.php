<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result\Json;

use Compwright\EasyApi\Result\DataAwareInterface;
use Compwright\EasyApi\Result\Result as BaseResult;

class Result extends BaseResult implements DataAwareInterface
{
    /**
     * @return array<int|string, mixed>
     */
    public function data(): array
    {
        $json = (string) $this->response->getBody();

        if ($json === '') {
            return [];
        }

        return (array) json_decode(
            $json,
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );
    }
}
