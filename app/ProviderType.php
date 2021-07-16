<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderType extends Model
{
    /**
     * Get all of the provider for the ProviderType
     *
     * @return HasMany
     */
    public function provider()
    {
        return $this->hasMany(Provider::class);
    }
}
