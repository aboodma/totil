<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookService extends Model
{
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
