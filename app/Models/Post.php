<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
     * @return array
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
}
