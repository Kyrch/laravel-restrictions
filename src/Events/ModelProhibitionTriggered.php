<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Kyrch\Prohibition\Models\Prohibition;

class ModelProhibitionTriggered
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Prohibition|string  $prohibition
     */
    public function __construct(public Model $model, public mixed $prohibition) {}
}
