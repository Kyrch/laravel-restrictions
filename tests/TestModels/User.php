<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Tests\TestModels;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Kyrch\Prohibition\Traits\HasSanctions;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable;
    use Authorizable;
    use HasSanctions;

    protected $fillable = ['email'];

    public $timestamps = false;

    protected $table = 'users';
}
