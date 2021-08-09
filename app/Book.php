<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $guarded = [];
    protected $table = 'books';
    public $timestamps = false;
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
