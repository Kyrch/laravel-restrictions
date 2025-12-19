<?php

declare(strict_types=1);

use Kyrch\Restriction\Models\Restriction;
use Kyrch\Restriction\Models\Sanction;

use function Illuminate\Support\now;

beforeEach(function (): void {
    Restriction::query()->create(['name' => 'restriction']);
    Sanction::query()->create(['name' => 'sanction']);
});

test('applies sanction to user', function (): void {
    $this->testUser->applySanction('sanction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->sanctions->isNotEmpty())->toBeTrue();
});

test('user is sanctioned', function (): void {
    $this->testUser->applySanction('sanction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeTrue();
});

test('user is not sanctioned', function (): void {
    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeFalse();
});

test('user is restricted via sanction', function (): void {
    Sanction::query()->first()->restrictions()->attach(
        Restriction::query()->first()
    );

    $this->testUser->applySanction('sanction', now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isRestrictedViaSanction('restriction'))->toBeTrue();
});

test('expires_at null means permanent sanction', function (): void {
    $this->testUser->applySanction('sanction', null);

    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeTrue();
});
