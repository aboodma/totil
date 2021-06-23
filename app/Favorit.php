<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    /**
     * Get the user that owns the Favorit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     /**
     * Get the user that owns the Favorit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
