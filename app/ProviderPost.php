<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderPost extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function comments()
    {
        return $this->hasMany(ProviderPostComment::class);
    }
    public function likes()
    {
        return $this->hasMany(ProviderPostLike::class);
    }
}
