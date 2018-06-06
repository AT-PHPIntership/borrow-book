<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book;
use App\Models\Category;
use DB;

class Category extends Model
{

    use SoftDeletes, Sortable;

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
    * Declare table sort
    *
    * @var array $sortable table sort
    */
    public $sortable = [
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
            foreach ($category->books as $book) {
                $book->ratings()->delete();
                $book->borrowDetails()->delete();
                $book->favorites()->delete();
                $book->posts()->delete();
                $book->imageBooks()->delete();
            }
            $category->books()->delete();
        });
    }
}
