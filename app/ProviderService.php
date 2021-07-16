<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderService extends Model
{
    /**
     * Get the service that owns the ProviderService
     *
     * @return BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the provider that owns the ProviderService
     *
     * @return BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
