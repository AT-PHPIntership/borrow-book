<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;

    /**
     * Post status
     *
     * @type int
     */
    const UNACCEPT = 0;
    const ACCEPT = 1;

    /**
     * Post post_type
     *
     * @type int
     */
    const COMMENT = 0;
    const REVIEW = 1;

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
        'user_id',
        'book_id',
        'post_type',
        'body',
        'rate_point',
        'status'
    ];

    /**
     * Relationship belongsTo with User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship belongsTo with Book
     *
     * @return array
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get posts follow type_post
     *
     * @param int $key key of type post
     *
     * @return \Illuminate\Http\Response
     */
    public static function postType($key)
    {
        return Post::where('post_type', $key);
    }
}
