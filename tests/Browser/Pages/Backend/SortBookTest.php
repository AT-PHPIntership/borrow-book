<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
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
        $categoryIds = DB::table('categories')->pluck('id')->all();
        $faker = Faker::create();
        factory(Book::class,16)->create([
            'category_id' => $faker->randomElement($categoryIds),
        ]);
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
            ['quantity', 'books.quantity', 5]
        ];
    }

    /**
     * A Dusk test data sort list user by name
     * 
     * @dataProvider dataForTest
     *
     * @return void
     */
    public function testSortListBook($name, $order, $columnIndex)
    {
        $this->browse(function (Browser $browser) use ($order, $name, $columnIndex) {
            $browser->loginAs($this->user)
                ->visit('admin/books')
                ->resize(1200,1600)
                ->click("#book-sort-$name a");
            //Test list user Desc
            $arrayAsc =Book::orderBy($order,'asc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arrayAsc[$i - 1]);
            }
            //Test list user Desc
           /* $browser->click("#book-sort-$name a");
            $arrayDesc = DB::table('books')->orderBy($order,'desc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arrayDesc[$i - 1]);
            }*/
        });
    }
    
}
