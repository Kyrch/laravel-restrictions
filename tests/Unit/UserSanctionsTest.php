<?php

declare(strict_types=1);

use Carbon\Carbon;
use Kyrch\Prohibition\Models\Prohibition;
use Kyrch\Prohibition\Models\Sanction;

beforeEach(function (): void {
    Prohibition::query()->create(['name' => 'prohibition']);
    Sanction::query()->create(['name' => 'sanction']);
});

test('applies sanction to user', function (): void {
    $this->testUser->applySanction('sanction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->sanctions->isNotEmpty())->toBeTrue();
});

test('user is sanctioned', function (): void {
    $this->testUser->applySanction('sanction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeTrue();
});

test('user is not sanctioned', function (): void {
    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeFalse();
});

test('user is prohibited via sanction', function (): void {
    Sanction::query()->first()->prohibitions()->attach(
        Prohibition::query()->first()
    );

    $this->testUser->applySanction('sanction', Carbon::now()->addDays(fake()->numberBetween(1, 10)));

    expect($this->testUser->isProhibitedViaSanction('prohibition'))->toBeTrue();
});

test('expires_at null means permanent sanction', function (): void {
    $this->testUser->applySanction('sanction', null);

    expect($this->testUser->hasSanctionNotExpired('sanction'))->toBeTrue();
});
