<?php

declare(strict_types = 1);

namespace App\BaseApp\Traits;

trait ResolveRouteBinding
{

    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value)) {
            return $this->where('uuid', $value)->firstOrFail();
        } else {
            return $this->where('slug', $value)->firstOrFail();
        }
    }
    public function getLocalizedRouteKey()
    {
        return $this->slug;
    }
}
