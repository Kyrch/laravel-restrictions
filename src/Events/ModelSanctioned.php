<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Kyrch\Restriction\Models\Sanction;

class ModelSanctioned
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Sanction|string  $sanction
     */
    public function __construct(public Model $model, public mixed $sanction) {}
}
