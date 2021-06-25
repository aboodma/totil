<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends  = ["price_with_currency","created_at_human"];
    public function getCreatedAtHumanAttribute(){
        \Carbon\Carbon::setLocale('en');
        return \Carbon\Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans() ;
    }

    public function getPriceWithCurrencyAttribute()
    {
        return $this->attributes['total_price'] . " USD";
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function details()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function rate()
    {
        return $this->hasOne(OrderReview::class);
    }
    
}
