<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

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
        'name',
        'email',
        'password',
        'identity_number',
        'avatar',
        'dob',
        'address',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
     * Relationship belongsToMany with Book
     *
     * @return array
     */
    public function ratings()
    {
        return $this->belongsToMany(Book::class, 'ratings', 'user_id', 'book_id')
            ->withPivot('rate')->withTimestamps();
    }

    /**
     * Relationship belongsToMany with User
     *
     * @return array
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'book_id')
            ->withTimestamps();
    }

    /**
     * Relationship hasMany with Borrow
     *
     * @return array
     */
    public function borrowes()
    {
        return $this->hasMany(Borrow::class);
    }
}
