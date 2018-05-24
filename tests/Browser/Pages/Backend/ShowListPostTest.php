<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Post;
use App\Models\Book;
use App\Models\Category;

class ShowListPostTest extends DuskTestCase
{
    use DatabaseMigrations;
    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;
    /**
    * Override function set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();

        factory(User::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Post::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * A Dusk test show list post.
     *
     * @return void
     */
    public function testShowListPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/posts')
                    ->assertPathIs('/admin/posts')
                    ->assertSee('List Post');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }
    /**
     * Test view Admin List Post with pagination
     *
     * @return void
     */
    public function testListPostPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/posts')
                    ->assertSee('List Post');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }
}
