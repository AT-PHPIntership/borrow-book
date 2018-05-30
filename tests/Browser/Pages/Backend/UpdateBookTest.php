<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;

class UpdateBookTest extends DuskTestCase
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
        factory(Book::class)->create([
            'id' => 2,
            'title' => 'ABC'
        ]);
    }

    /**
     * Test url update book
     *
     * @return void
     */
    public function testUpdateBooksUrl()
    {
        $book = Book::findOrFail(2);
        $this->browse(function (Browser $browser) use ($book) {
            $browser->loginAs($this->user)
                ->visit('/admin/books/')
                ->click('#table-index tbody tr:nth-child(1) .button-edit')
                ->assertSee('Update Book')
                ->assertPathIs('/admin/books/'.$book->id.'/edit');
        });
        $this->assertDatabaseHas('books', ['title' => $book->title]);
    }

    /**
     * List case for Test validate for input Update Book
     *
     * @return array
     */
    public function testValidateForInput()
    {
        $book = Book::findOrFail(2);
        $this->browse(function (Browser $browser) use ($book) {
            $browser->loginAs($this->user)
                ->visit('/admin/books/')
                ->click('#table-index tbody tr:nth-child(1) .button-edit')
                ->assertSee('Update Book')
                ->assertPathIs('/admin/books/'.$book->id.'/edit')
                ->type('title', '')
                ->type('description', '')
                ->type('number_of_page', '')
                ->type('author', '')
                ->type('quantity', '');
            $browser->press('Submit')
                ->pause(1000)
                ->assertSee('The title field is required.')
                ->assertSee('The description field is required.')
                ->assertSee('The number of page field is required.')
                ->assertSee('The author field is required.')
                ->assertSee('The quantity must be an integer.');
        });
    }
}
