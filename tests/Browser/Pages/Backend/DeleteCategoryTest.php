<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use App\Models\Post;
use App\Models\Borrow;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\BorrowDetail;
use App\Models\Book;
use App\Models\ImageBook;
use Faker\Factory as Faker;
use DB;

class DeleteCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
    * Function set up database test.
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        factory(Category::class)->create();
        factory(Book::class)->create();
        factory(Post::class)->create();
        factory(Favorite::class)->create();
        factory(Rating::class)->create();
        factory(Borrow::class)->create();
        factory(BorrowDetail::class)->create();
    }

}
