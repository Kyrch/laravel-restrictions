<?php

declare(strict_types=1);

use Kyrch\Restriction\Models\Restriction;
use Kyrch\Restriction\Models\Sanction;

use function Illuminate\Support\now;

beforeEach(function (): void {
    Restriction::query()->create(['name' => 'restriction']);
    Sanction::query()->create(['name' => 'sanction']);
});

test('applies restriction to user', function (): void {
    $this->testUser->restrict('restriction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->restrictions->isNotEmpty())->toBeTrue();
});

test('user is restricted', function (): void {
    $this->testUser->restrict('restriction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isRestricted('restriction'))->toBeTrue();
});

test('user is not restricted', function (): void {
    expect($this->testUser->isRestricted('restriction'))->toBeFalse();
});

test('user is directly restricted', function (): void {
    $this->testUser->restrict('restriction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isDirectlyRestricted('restriction'))->toBeTrue();
});

test('user is not directly restricted when sanctioned', function (): void {
    $this->testUser->applySanction('sanction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isDirectlyRestricted('restriction'))->toBeFalse();
});
