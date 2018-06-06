<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book;
use DB;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name'
    ];

    /**
     * Relationship hasMany with Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Delete one category.
     *
     * @return message
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->books()->delete();
            foreach ($category->books() as $book) {
                $book->ratings()->delete();
                $book->borrowDetails()->delete();
                $book->favorites()->delete();
                $book->posts()->delete();
                $book->imageBooks()->delete();
            }
        });
    }
}
