<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
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
     * Relationship belongsTo with Category
     *
     * @return array
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relationship hasMany with ImageBook
     *
     * @return array
     */
    public function imageBooks()
    {
        return $this->hasMany(ImageBook::class);
    }

    /**
     * Relationship hasMany with Post
     *
     * @return array
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relationship belongsToMany with User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings', 'user_id', 'book_id')
            ->withPivot('rate')->withTimestamps();
    }

    /**
     * Relationship belongsToMany with User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'book_id')
            ->withTimestamps();
    }

    /**
     * Relationship belongsToMany with Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function borrowDetails()
    {
        return $this->belongsToMany(Borrow::class, 'borrow_details', 'borrow_id', 'book_id')
            ->withTimestamps();
    }
}
