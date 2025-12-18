<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelRestricted
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Restriction|string  $restriction
     */
    public function __construct(public Model $model, public mixed $restriction) {}
}
