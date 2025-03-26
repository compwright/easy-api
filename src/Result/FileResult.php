<?php

declare(strict_types=1);

namespace Compwright\EasyApi\Result;

final class FileResult extends Result implements StreamAwareInterface
{
    use StreamAwareTrait;
}
