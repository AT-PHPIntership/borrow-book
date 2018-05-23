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

        $category = factory(Category::class, 2)->create();
    }

    /**
     * Test url create book
     *
     * @return void
     */
    public function testCreateBooksUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/books/create')
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
            $browser->loginAs($this->user)
                ->visit('admin/books/create')
                ->select('category_id', '2')
                ->type('title', 'Title for book')
                ->type('description', 'Lorem ABC')
                ->type('number_of_page', '1000')
                ->type('author', 'ABC')
                ->keys('#publishing_year', '11-22-2012')
                ->type('quantity', '2');         
            $browser->press('Submit')
                    ->pause(1000)
                    ->assertSee('Successfully created book!');
            $this->assertDatabaseHas('books', [
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
        });
    }

    /**
     * List case for Test validate for input Create Book
     *
     * @return array
     */
    public function testBookValidateForInput()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/books/create')
                ->type('title', '')
                ->type('description', '')
                ->type('number_of_page', '')
                ->type('author', '')
                ->keys('#publishing_year', '')
                ->type('quantity', '');
            $browser->press('Submit')
                ->pause(1000)
                ->assertSee('The title field is required.')
                ->assertSee('The description field is required.')
                ->assertSee('The number of page field is required.')
                ->assertSee('The author field is required.')
                ->assertSee('The publishing year does not match the format Y-m-d.')
                ->assertSee('The quantity must be an integer.');
        });
    }
}
