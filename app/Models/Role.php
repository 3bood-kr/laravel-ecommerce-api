<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Guard;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    public static function findById(int|string $id, ?string $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $role = static::findByParam([(new static())->getKeyName() => $id, 'guard_name' => $guardName]);

        if (! $role) {
            Response::errorNotFound();
        }

        return $role;
    }
}
