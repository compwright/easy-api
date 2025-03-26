<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

interface PaginatedResultInterface
{
    public function totalCount(): int;

    public function currentPage(): int;

    public function pageLimit(): int;

    public function hasMore(): bool;
}
