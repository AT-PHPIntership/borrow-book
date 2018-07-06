<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use SoftDeletes;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'borrowes';

    /**
     * Borrows status
     *
     * @type int
     */
    const BORROWING = 0;
    const GIVE_BACK = 1;
    const WAITTING = 2;
    const CANCEL = 3;

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
        'from_date'
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
     * Relationship hasMany with BorrowDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class);
    }

    /**
     * Relationship hasOne with Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function note()
    {
        return $this->hasOne(Note::class);
    }
}
