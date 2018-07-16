<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Sortable, HasApiTokens;

    /**
     * User role
     *
     * @type int
     */
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * User recommend
     *
     * @type int
     */
    const TURN_OFF = 0;
    const TURN_ON = 1;

    /**
     * Weekdays
     *
     * @type array
     */
    const WEEK_DAYS = [
        'sunday' => 0,
        'monday' => 1,
        'tuesday' => 2,
        'wednesday' => 3,
        'thursday' => 4,
        'friday' => 5,
        'saturday' => 6
    ];

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
        'role',
        'date_recommend',
        'flag_recommend'
    ];
    
    /**
    * Declare table sort
    *
    * @var array $sortable table sort
    */
    public $sortable = [
        'name',
        'email'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relationship hasMany with Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
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
     * Relationship hasMany with Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrowes()
    {
        return $this->hasMany(Borrow::class);
    }

    /**
     * Get the user's avatar.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset(config('image.images_path') . $this->avatar);
        }
        return asset(config('image.images_path') . 'default-user.png');
    }

    /**
     * Custom toArray Model User.
     *
     * @return string
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'identity_number' => $this->identity_number,
            'avatar' => $this->avatar_url,
            'dob' => $this->dob,
            'address' => $this->address,
            'role' => $this->role
        ];
    }
}
