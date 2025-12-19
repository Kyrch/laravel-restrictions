<?php

declare(strict_types=1);

use Carbon\Carbon;
use Kyrch\Restriction\Models\Restriction;
use Kyrch\Restriction\Models\Sanction;

beforeEach(function (): void {
    Restriction::query()->create(['name' => 'restriction']);
    Sanction::query()->create(['name' => 'sanction']);
});

test('applies restriction to user', function (): void {
    $this->testUser->restrict('restriction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->restrictions->isNotEmpty())->toBeTrue();
});

test('user is restricted', function (): void {
    $this->testUser->restrict('restriction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isRestricted('restriction'))->toBeTrue();
});

test('user is not restricted', function (): void {
    expect($this->testUser->isRestricted('restriction'))->toBeFalse();
});

test('user is directly restricted', function (): void {
    $this->testUser->restrict('restriction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isDirectlyRestricted('restriction'))->toBeTrue();
});

test('user is not directly restricted when sanctioned', function (): void {
    $this->testUser->applySanction('sanction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isDirectlyRestricted('restriction'))->toBeFalse();
});

test('expires_at null means permanent restriction', function (): void {
    $this->testUser->restrict('restriction', null);

    expect($this->testUser->isRestricted('restriction'))->toBeTrue();
});
