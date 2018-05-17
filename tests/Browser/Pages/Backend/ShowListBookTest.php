<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;

class ShowListBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;

    /**
    * Override function setUp() for make book
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        
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
                    ->assertPathIs('/admin/books');
        });
    }
}
