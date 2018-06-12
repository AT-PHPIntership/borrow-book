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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the book's image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return asset(config('image.images_path') . $this->image);
    }

    /**
     * Custom toArray Model ImageBook.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'book_id' => $this->book_id,
            'image' => $this->getImageUrlAttribute()
        ];
    }
}
