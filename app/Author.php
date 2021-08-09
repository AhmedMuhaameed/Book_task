<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];
    protected $table = 'authors';
    public $timestamps = false;

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
