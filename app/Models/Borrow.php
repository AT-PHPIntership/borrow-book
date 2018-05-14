<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
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
        'status',
        'number_book',
        'to_date',
        'form_date'
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
     * Relationship belongsToMany with Book
     *
     * @return array
     */
    public function borrowDetails()
    {
        return $this->belongsToMany(Book::class, 'borrow_details', 'borrow_id', 'book_id')
            ->withTimestamps();
    }
}
