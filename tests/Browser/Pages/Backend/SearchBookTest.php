<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;

class SearchBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
    * Override function setUp() for make book login
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        
        factory(Category::class, 2)->create();
        factory(Book::class)->create([
        	'id' => 1,
            'category_id' => 2,
            'title' => 'Title for book',
            'description' => 'Lorem ABC',
            'number_of_page' => 1000,
            'author' => 'ABC',
            "publishing_year" => '2012-11-22',
            "language" => 'English',
            'quantity' => 2,
            'count_rate' => 0
        ]);
        factory(Book::class)->create([
        	'id' => 2,
            'category_id' => 1,
            'title' => 'Flower',
            'description' => 'Lorem ABC',
            'number_of_page' => 1000,
            'author' => 'Flower',
            "publishing_year" => '2012-11-22',
            "language" => 'France',
            'quantity' => 2,
            'count_rate' => 0
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
            $this->assertCount(2, $elements);
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
                ->assertSee('List Book');
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
}
