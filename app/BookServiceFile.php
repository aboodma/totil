<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookServiceFile extends Model
{
    public function bookService()
    {
        return $this->belongsTo(BookService::class);
    }
}
