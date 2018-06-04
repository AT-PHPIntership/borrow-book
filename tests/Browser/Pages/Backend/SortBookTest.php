<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;
use Faker\Factory as Faker;

class SortBookTest extends DuskTestCase
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
        
        factory(Category::class,2)->create();
        factory(Book::class,17)->create();
    }

    /*
     * A Dusk test for click link sort
     *
     * @return void
     */
    public function testClickLinksSortBook()
    { 
        $sortNames = ['title', 'author', 'quantity'];
        $this->browse(function (Browser $browser) use ($sortNames) {
            $browser->loginAs($this->user)
                ->visit('/admin/books');
            foreach ($sortNames as $name) {
                $browser->click("#book-sort-$name a")
                    ->assertQueryStringHas('sort', $name)
                    ->assertQueryStringHas('order', 'asc')
                    ->click("#book-sort-$name a")
                    ->assertQueryStringHas('sort', $name)
                    ->assertQueryStringHas('order', 'desc');
            }
        });
    }

    /**
     * Make cases for test.
     *
     * @return array
     */
    public function dataForTest()
    {
        return [
            ['title', 'books.title', 2],
            ['author', 'books.author', 3],
            ['quantity','books.quantity', 5],        
        ];
    }

    /**
     * A Dusk test Sort List Books.
     *
     * @dataProvider dataForTest
     *
     * @return void
     */
    public function testSortListBooks($name,$order, $columIndex)
    {
        $this->browse(function (Browser $browser) use ($name,$order, $columIndex) {
            $browser->loginAs($this->user)
                ->visit('admin/books')
                ->resize(1200, 1600)
                ->press("#book-sort-$name a");
            // Test list Asc
            $arrAsc =Book::with('category')->orderBy($order,'asc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columIndex)";
                $this->assertEquals($browser->text($selector), $arrAsc[$i - 1]);
            }
            // Test list Desc
            $browser->press("#book-sort-$name a");
            $arrDesc = Book::with('category')->orderBy($order,'desc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columIndex)";
                $this->assertEquals($browser->text($selector), $arrDesc[$i - 1]);
            }
        });
    }

    /**
     * A Dusk test sort list books when panigate.
     *
     * @dataProvider dataForTest
     *
     * @return void
     */
    public function testSortListBooksWhenPanigate($name, $order, $columIndex)
    {
        $this->browse(function (Browser $browser) use ($name, $order, $columIndex) {
            $browser->loginAs($this->user)
                ->visit('admin/books')
                ->resize(1200, 1600)
                ->click("#book-sort-$name a")
                ->clickLink("2");
            // Test list Asc
            $arrAsc = Book::with('category')->orderBy($order,'asc')->pluck($name)->toArray();
            $arraySortAsc = array_chunk($arrAsc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columIndex)";
                $this->assertEquals($browser->text($selector), $arraySortAsc[$i - 1]);
            }
            // Test list Desc
            $browser->press("#book-sort-$name a")
                    ->clickLink("2");
            $arrAsc = Book::with('category')->orderBy($order,'desc')->pluck($name)->toArray();
            $arraySortDesc = array_chunk($arrAsc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columIndex)";
                $this->assertEquals($browser->text($selector), $arraySortDesc[$i - 1]);
            }
        });
    }

   
}
