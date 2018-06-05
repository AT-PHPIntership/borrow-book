<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BorrowDetail;
use App\Models\Borrow;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\Book;
use App\Models\ImageBook;
use App\Models\Post;
use Session;
use DB;

class Category extends Model
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
            DB::beginTransaction();
            try {
                $books = Book::where('category_id', $category->id)->get();
                if ($books->count()) {
                    foreach ($books as $book) {
                        Favorite::where('book_id', $book->id)->delete();
                        Post::where('book_id', $book->id)->delete();
                        Rating::where('book_id', $book->id)->delete();
                        ImageBook::where('book_id', $book->id)->delete();
                        $borroweDetails = BorrowDetail::where('book_id', $book->id)->get();
                        if ($borroweDetails->count()) {
                            foreach ($borroweDetails as $borroweDetail) {
                                Borrow::where('id', $borroweDetail->borrow_id)->delete();
                            }
                            BorrowDetail::where('book_id', $book->id)->delete();
                        }
                    }
                    $category->books()->delete();
                }
                DB::commit();
                Session::flash('message_success', trans('category.messages.delete_success'));
            } catch (Exception $e) {
                DB::rollback();
                Session::flash('message_fail', trans('category.messages.delete_fail'));
            }
        });
    }
}
