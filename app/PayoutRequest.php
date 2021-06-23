<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    /**
     * Get the user that owns the PayoutRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
