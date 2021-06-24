<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function provider()
    {
       return $this->belongsTo(Provider::class);
    }
    public function services()
    {
       return $this->hasMany(BookService::class);
    }
}
