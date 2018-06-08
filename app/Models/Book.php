<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The Book language
     *
     * @type array
     */
    const LANGUAGES = [
        'English',
        'VietNamese'
    ];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'number_of_page',
        'author',
        'publishing_year',
        'language',
        'quantity',
        'count_rate'
    ];

    /**
    * Declare table sort
    *
    * @var array $sortable table sort
    */
    public $sortable = [
        'title',
        'author',
        'quantity'
    ];

    /**
     * Relationship belongsTo with Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relationship hasMany with ImageBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageBooks()
    {
        return $this->hasMany(ImageBook::class);
    }

    /**
     * Relationship hasMany with Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relationship hasMany with Rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Relationship hasMany with Favorite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relationship HasMany with BorrowDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class);
    }

    /**
     * Get search book
     *
     * @param int $key key of search book
     *
     * @return \Illuminate\Http\Response
     */
    public static function search($key)
    {
        return Book::whereHas('category', function ($query) use ($key) {
                $query->where('name', 'like', "%$key%");
        })
            ->orWhere('title', 'like', "%$key%")
            ->orWhere('author', 'like', "%$key%")
            ->orWhere('language', 'like', "%$key%");
    }
}
