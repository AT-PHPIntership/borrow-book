<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageBook extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'book_id',
        'image'
    ];

    /**
     * Relationship belongsTo with Book
     *
     * @return array
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
