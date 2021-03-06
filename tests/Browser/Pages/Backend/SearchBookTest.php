<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SearchBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;

    /**
    * Override function setUp() for make book login
    *
    * @return void
    */
    public function setUp()
    {
        $languages = ['English', 'VietNamese'];
        parent::setUp();
        
        factory(Category::class, 5)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class)->create([
            'title' => 'Flower',
        ]);
    }

    /**
     * A Dusk test show list book.
     *
     * @return void
     */
    public function testButtonSearchBook()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->click('.button-search-book')
                ->assertSee('List Book');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test show result of search with data input, has records return
     *
     * @return void
     */
    public function testSearchBookHasRecordReturn()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->assertSee('List Book')
                ->type('search', 'Flower')
                ->click('.button-search-book')
                ->assertSee('List Book')
                ->assertSee('Found 1 results');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(1, $elements);
        });
    }

    /**
     * Test show result of search with data input, no record return
     *
     * @return void
     */
    public function testSearchBookNoRecordReturn()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->assertSee('List Book')
                ->type('search', 'hahaha')
                ->click('.button-search-book')
                ->assertSee('List Book');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(0, $elements);
        });
    }

    /**
     * Test pagination of search
     *
     * @return void
     */
    public function tesSearchPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->assertSee('List Book')
                ->type('search', 'a')
                ->click('.button-search-book')
                ->assertSee('List Book');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }

    /**
     * Test pagination page 2 of search
     *
     * @return void
     */
    public function testRecordSearchInPageTwo()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->assertSee('List Book')
                ->type('search', 'a')
                ->click('.button-search-book')
                ->assertSee('List Book')
                ->clicklink('2')
                ->visit('/admin/books?search=a&page=2');
            $elements = $browser->elements('.table tbody tr');
            $this->assertTrue($elements != 0);
        });
    }
}
