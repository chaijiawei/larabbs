<?php

namespace App\Models;

use Spatie\Permission\Models\Role as OriginRole;

class Role extends OriginRole
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
