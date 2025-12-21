<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Exceptions;

use InvalidArgumentException;

class SanctionDoesNotExist extends InvalidArgumentException
{
    public static function name(string $sanctionName): SanctionDoesNotExist
    {
        return new SanctionDoesNotExist(sprintf('There is no sanction named [%s].', $sanctionName));
    }
}
