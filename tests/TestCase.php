<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Kyrch\Restriction\RestrictionServiceProvider;
use Kyrch\Restriction\Tests\TestModels\User;
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

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kyrch\\Restriction\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->softDeletes();
        });

        self::$migration->up();

        $this->testUser = User::create(['email' => 'test@user.com']);
    }

    protected function prepareMigration(): void
    {
        self::$migration = include __DIR__.'/../database/migrations/create_restriction_tables.php.stub';
    }

    protected function getPackageProviders($app)
    {
        return [
            RestrictionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
