<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Exceptions;

use InvalidArgumentException;

class ProhibitionDoesNotExist extends InvalidArgumentException
{
    public static function name(string $prohibitionName): ProhibitionDoesNotExist
    {
        return new ProhibitionDoesNotExist(sprintf('There is no prohibition named [%s].', $prohibitionName));
    }
}
