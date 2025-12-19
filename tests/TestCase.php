<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Kyrch\Prohibition\ProhibitionServiceProvider;
use Kyrch\Prohibition\Tests\TestModels\User;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected User $testUser;

    protected static $migration;

    protected function setUp(): void
    {
        parent::setUp();

        if (! self::$migration) {
            $this->prepareMigration();
        }

        $this->setUpDatabase($this->app);
    }

    protected function setUpDatabase(Application $app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('users', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('email');
        });

        self::$migration->up();

        $this->testUser = User::query()->create(['email' => 'test@user.com']);
    }

    protected function prepareMigration(): void
    {
        self::$migration = include __DIR__.'/../database/migrations/2025_12_19_011632_create_prohibition_tables.php';
    }

    protected function getPackageProviders($app)
    {
        return [
            ProhibitionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
