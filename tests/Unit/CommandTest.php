<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Kyrch\Prohibition\Models\Prohibition;
use Kyrch\Prohibition\Models\Sanction;

test('create prohibition', function (): void {
    Artisan::call('prohibition:create-prohibition', [
        'name' => 'test-prohibition',
    ]);

    $this->assertCount(1, Prohibition::query()->where('name', 'test-prohibition')->get());
    $this->assertCount(0, Prohibition::query()->where('name', 'test-prohibition')->first()->sanctions);
});

test('create sanction', function (): void {
    Artisan::call('prohibition:create-sanction', [
        'name' => 'test-sanction',
    ]);

    $this->assertCount(1, Sanction::query()->where('name', 'test-sanction')->get());
    $this->assertCount(0, Sanction::query()->where('name', 'test-sanction')->first()->prohibitions);
});
