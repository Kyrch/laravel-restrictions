<?php

declare(strict_types=1);

use Kyrch\Restriction\Models\Sanction;

use function Illuminate\Support\now;

beforeEach(function () {
    Sanction::query()->create(['name' => 'sanction']);
});

test('applies sanction to user', function () {
    $this->testUser->applySanction('sanction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->sanctions->isNotEmpty())->toBeTrue();
});
