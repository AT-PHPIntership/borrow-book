<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;

class CreateBookTest extends DuskTestCase
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

        factory(Category::class, 2)->create();
    }

    /**
     * Test url create book
     *
     * @return void
     */
    public function testCreateBooksUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/books/create')
                ->assertPathIs('/admin/books/create')
                ->assertSee('Create Book');
        });
    }

    /**
     * Dusk test create book success.
     *
     * @return void
     */
    public function testCreatesBookSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/books/create')
                ->type('title', 'Title for book')
                ->type('description', 'Lorem ABC')
                ->type('number_of_page', '1000')
                ->type('author', 'Cao Nguyen V.')
                ->keys('#publishing_year', '11-22-2012')
                ->type('quantity', '2');
            $browser->press('Submit')
                ->pause(1000)
                ->assertSee('Successfully created book!');
        });
    }
}
