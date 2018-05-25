<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DeletePostTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
    * Override function set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        factory(User::class,2)->create();
        $userId = DB::table('users')->pluck('id')->all();
        factory(Category::class,2)->create();
        $categoryId = DB::table('categories')->pluck('id')->all();
        $faker = Faker::create();
        factory(Book::class, 1)->create([
            'category_id' => $faker->randomElement($categoryId),
        ]);
        $bookId = DB::table('books')->pluck('id')->all();
        factory(Post::class,1)->create([
            'user_id' =>$faker ->randomElement($userId),
            'book_id' =>$faker ->randomElement($bookId),
        ]);
    }

    /**
     * Test Admin click button delete post in List Posts
     *
     * @return void
     */
    public function testClickButtonDeletePost()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/posts')
                    ->assertSee('List Post')
                    ->click('td button.fa-trash-o')
                    ->assertDialogOpened('Are you sure you want to deleted?')
                    ->dismissDialog();
            $this->assertDatabaseHas('posts',['deleted_at' => null]);
        });
    }

    /**
     * Test confirm delete 
     *
     * @return void
     */
    public function testConfirmDeleteOnPopup()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/posts')
                    ->assertSee('List Post');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(1, $elements);
            $browser->click('td button.fa-trash-o')
                    ->assertDialogOpened('Are you sure you want to deleted?')
                    ->acceptDialog()
                    ->assertSee('Delete Post Success!');
            $this->assertDatabaseMissing('posts', ['deleted_at' => null]);
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(0, $elements);
        });
    }
}
