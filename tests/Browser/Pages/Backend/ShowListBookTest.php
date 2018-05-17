<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use App\Models\Book;

class ShowListBookTest extends DuskTestCase
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

        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * A Dusk test show list book.
     *
     * @return void
     */
    public function testShowList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/books')
                    ->assertPathIs('/admin/books')
                    ->assertSee('List Book');
        });
    }

    /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/books')
                ->assertSee('List Book');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test view Admin List Book with pagination
     *
     * @return void
     */
    public function testListBooksPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/books')
                ->assertSee('List Book');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }
}
