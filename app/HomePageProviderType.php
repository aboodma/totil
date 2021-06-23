<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePageProviderType extends Model
{
    public function providerType()
    {
        return $this->belongsTo(ProviderType::class);
    }
}
