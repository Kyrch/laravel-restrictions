<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Kyrch\Prohibition\Models\Sanction;

class ModelSanctionTriggered
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Sanction|string  $sanction
     */
    public function __construct(public Model $model, public mixed $sanction) {}
}
