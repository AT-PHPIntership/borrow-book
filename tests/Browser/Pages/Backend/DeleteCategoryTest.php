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
        factory(Borrow::class,1)->create();
        $borrowId = DB::table('borrowes')->pluck('id')->all();
        $faker = Faker::create();
        factory(BorrowDetail::class,2)->create([
            'borrow_id' => $faker->randomElement($borrowId),
        ]);
    }

    /**
     * Test button delete book in list category
     *
     * @return void
     */
    public function testButtonCancelDeleleUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->assertSee('List Category')
                ->click('.btn-delete-item')
                ->assertDialogOpened('Are you sure?')
                ->dismissDialog();
            $this->assertDatabaseHas('categories', ['id' => 1, 'deleted_at' => null]);
        });
    }

    /**
     * Test click button Delete
     *
     * @return void
     */
    public function testAppectDeleleUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->click('.btn-delete-item')
                ->assertDialogOpened('Are you sure?')
                ->acceptDialog()
                ->pause(1000)
                ->assertSee('Delete Category Successfully!');
            $this->assertDatabaseMissing('categories', ['id' => 1, 'deleted_at' => null])
                ->assertDatabaseMissing('posts', ['id'=> 1, 'deleted_at' => null])
                ->assertDatabaseMissing('ratings', ['id'=> 1])
                ->assertDatabaseMissing('favorites', ['id'=> 1])
                ->assertDatabaseMissing('borrow_details', ['id'=> 1])
                ->assertDatabaseMissing('books', ['id'=> 1, 'deleted_at' => null]);
        });
    }
}
