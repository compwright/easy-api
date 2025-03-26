<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

interface DataAwareInterface
{
    /**
     * @return array<int|string, mixed>
     */
    public function data(): array;
}
