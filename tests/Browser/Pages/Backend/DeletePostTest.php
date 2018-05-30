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
        $userIds = DB::table('users')->pluck('id')->all();
        factory(Category::class,2)->create();
        $categoryIds = DB::table('categories')->pluck('id')->all();
        $faker = Faker::create();
        factory(Book::class, 2)->create([
            'category_id' => $faker->randomElement($categoryIds),
        ]);
        $bookIds = DB::table('books')->pluck('id')->all();
        factory(Post::class,3)->create();
        factory(Post::class)->create([
            'id' => 4,
            'user_id' =>$faker ->randomElement($userIds),
            'book_id' =>$faker ->randomElement($bookIds),
        ]);
    }

    /**
     * Test Admin click button delete post in List Posts
     *
     * @return void
     */
    public function testCancelConfirmDelete()
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
     * Test accept confirm delete 
     *
     * @return void
     */
    public function testAcceptConfirmDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/posts')
                    ->assertSee('List Post')
                    ->click('tr:nth-child(4) td button.fa-trash-o')
                    ->assertDialogOpened('Are you sure you want to deleted?')
                    ->acceptDialog()
                    ->assertSee('Delete Post Success!');
            $this->assertDatabaseMissing('posts', ['id'=>4 , 'deleted_at' => null]);
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(3, $elements);
        });
    }
}
