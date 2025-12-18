<?php

declare(strict_types=1);

namespace Kyrch\LaravelRestrictions\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Kyrch\LaravelRestrictions\Models\Sanction;

class ModelSanctioned
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Sanction|string  $sanction
     */
    public function __construct(public Model $model, public mixed $sanction) {}
}
