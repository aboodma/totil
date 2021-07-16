<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorit extends Model
{
    /**
     * Get the user that owns the Favorit
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Favorit
     *
     * @return BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
