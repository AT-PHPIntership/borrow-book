<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailBookTest extends DuskTestCase
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
        factory(Book::class)->create([
            'id' => 2,
            'category_id' => $faker->randomElement($categoryIds),
        ]);
        factory(Book::class)->create([
            'id' => 1,
            'publishing_year' => null,
            'category_id' => $faker->randomElement($categoryIds),
        ]);
    }

    /**
     * A Dusk test click button detail book
     *
     * @return void
     */
    public function testClickButtonDetailBook()
    {
        $book = Book::findOrFail(2);
        $this->browse(function (Browser $browser) use ($book){
            $browser->loginAs($this->user)
                ->visit('/admin/books')
                ->click('.table tbody tr:nth-child(2) .button-info')
                ->assertPathIs('/admin/books/'.$book->id)
                ->assertSee('Detail Book');
        });
    }

    /**
     * A Dusk test Show Detail Book
     *
     * @return void
     */
    public function testShowDetailBook()
    {
        $book = Book::findOrFail(2);
        $this->browse(function (Browser $browser) use ($book) {
            $browser->loginAs($this->user)
                ->visit('/admin/books/' . $book->id);
            $this->assertTrue($browser->text('.title') === $book->title);
            $this->assertTrue($browser->text('.description') === $book->description);
            $this->assertTrue($browser->text('.author') === $book->author);
            $this->assertTrue($browser->text('.publishing-year') === $book->publishing_year);
            $this->assertTrue($browser->text('.language') === $book->language);
            $this->assertTrue($browser->text('.category') === $book->category->name);
            $pageNumber = $browser->text('ul li:nth-child(3) p');
            $quantity = $browser->text('ul li:nth-child(7) p');
            $this->assertEquals($book->quantity, $quantity);
            $this->assertEquals($book->number_of_page, $pageNumber);
        });
    }

    /**
     * A Dusk test Miss Data Book
     *
     * @return void
     */
    public  function testMissingDataBook()
    {
        $book = Book::findOrFail(1);
        $this->browse(function (Browser $browser) use ($book) {
            $browser->loginAs($this->user)
                ->visit('/admin/books/' . $book->id);
            $this->assertTrue($browser->text('.publishing-year') === '');
        });
    }
}
