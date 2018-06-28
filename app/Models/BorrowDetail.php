<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
    use SoftDeletes;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'borrow_id',
        'book_id',
        'quantity'
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
     * Relationship belongsTo with Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrow()
    {
        return $this->belongsTo(Borrow::class, 'borrow_id');
    }
}
