<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ProviderType that owns the Provider
     *
     * @return BelongsTo
     */
    public function ProviderType()
    {
        return $this->belongsTo(ProviderType::class);
    }

    /**
     * Get the Country that owns the Provider
     *
     * @return BelongsTo
     */
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all of the services for the Provider
     *
     * @return HasMany
     */
    public function services()
    {
        return $this->hasMany(ProviderService::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function Reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function posts()
    {
        return $this->hasMany(ProviderPost::class);
    }
}
