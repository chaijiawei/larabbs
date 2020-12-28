<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as OriginPermission;

class Permission extends OriginPermission
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
